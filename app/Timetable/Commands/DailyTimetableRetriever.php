<?php

namespace App\Timetable\Commands;

use App\Models\Course;
use App\Timetable\Converters\ConvertTimetableFilters;
use App\Timetable\Exceptions\ReturnedBadResponseException;
use App\Timetable\Jobs\CreateCourseSchedules;
use App\Timetable\Jobs\CreateDepartmentCourses;
use App\Timetable\TimetableSourceLinkCreator;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DailyTimetableRetriever extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:week
                            {week? : The week to be scraped.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrap schedules for the week, defaults to current week.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TimetableSourceLinkCreator $linkCreator)
    {
        parent::__construct();

        $this->linkCreator = $linkCreator;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            DB::transaction(function() {
                $this->info('Dispatching filter crawlers...');
                CreateDepartmentCourses::dispatchNow(new ConvertTimetableFilters(Http::get(config('timetable.url.filter'))->body()));
                $this->info('Completed...');

                // wait untill we can get a count.
                $this->info('Waiting for courses to process into table..');

                $courses = Course::all();

                $this->info($courses->count() . " courses found");

                $this->output->progressStart($courses->count());
                $this->info('Dispatching timetable jobs...');

                foreach ($courses as $course)
                {
                    try {
                        CreateCourseSchedules::dispatch($course, $this->createLinkForCourse($course));
                    } catch (ReturnedBadResponseException $e) {
                        Log::info($e->getMessage());
                    }

                    $this->output->progressAdvance();
                }

                $this->info("Done!");

                $this->output->progressFinish();
                $this->info('Completed...');
            });
        }
        catch (ConnectionException $exception) {
            $this->error($exception->getMessage());
            $this->error("Website offline or bad connection.");
        }
    }

    /**
     *
     */
    private function createLinkForCourse(Course $course)
    {
        if ($week = $this->argument('week')) {
            return $this->linkCreator->setCourse($course)->setWeek($week)->generate();
        }

        return $this->linkCreator->setCourse($course)->generate();
    }
}
