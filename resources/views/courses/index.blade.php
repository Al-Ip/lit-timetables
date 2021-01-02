@extends('layouts.app')

@section('content')

    <div id="application">

        @push('scripts')
            <script src="https://unpkg.com/typewriter-effect@latest/dist/core.js"></script>

            <script>
                new Typewriter('#introduction', {
                    strings: ['simplicity.', 'GraphQL support.', ' beautiful design.', 'mobile-first approach.', ' notification channels.', 'weather updates.'],
                    autoStart: true,
                    delay: 75,
                    loop: true,
                });
            </script>
        @endpush

        <div class="container pb-12">
            <div class="max-w-full pt-24 prose">
                <h1 class="mb-1 text-4xl">LIT Timetables with<br>
                <span id="introduction" class="mt-0 text-blue-600 introduction-lure">Speed.</span></h1>
                <p class="text-lg text-cool-gray-500">Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fungiat veniam occaecat fugiat aliqua ad ad non deserunt sunt.</p>
            </div>

            <div class="py-16">
                @livewire('search-bar')
            </div>
        </div>

        <div class="container grid grid-cols-4 gap-12 mb-2 text-center">
            <div class="col-span-1">
                <img class="w-full h-32 rounded shadow" src="https://www.limerick.ie/sites/default/files/styles/hero_image/public/media/images/2017-04/LIT-810x456.jpg?itok=1KlVctoj" alt="">
                <h3 class="col-span-1 text-cool-gray-400">Moylish</h3>
            </div>
            <div class="col-span-1">
                <img class="w-full h-32 rounded shadow" src="https://media-cdn.tripadvisor.com/media/photo-s/03/cd/16/cd/tipperary-institute.jpg" alt="">
                <h3 class="col-span-1 text-cool-gray-400">Clonmel</h3>
            </div>
            <div class="col-span-1">
                <img class="w-full h-32 rounded shadow" src="data:image/jpeg;base64,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" alt="">
                <h3 class="col-span-1 text-cool-gray-400">Ennis</h3>
            </div>
            <div class="col-span-1">
                <img class="w-full h-32 rounded shadow" src="data:image/jpeg;base64,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" alt="">
                <h3 class="col-span-1 text-cool-gray-400">Thurls</h3>
            </div>
        </div>


        <div class="container prose">
            <div class="grid grid-cols-2">
                <div class="col-span-1">
                    left
                </div>
                <div class="col-span-1">
                    <h2>Find whats important</h2>
                    <p>Our timetable platform offers a glancable view of what is really important right now.</p>
                </div>
            </div>
        </div>

        <div class="container prose">
            <div class="grid grid-cols-2">
                <div class="col-span-1">
                    <h2>Notification Alerts</h2>
                    <p>When a schedule changes, we can send you an alert by email or text message, keeping you up to date. </p>
                </div>
                <div class="col-span-1">
                    Right
                </div>
            </div>
        </div>

        <div class="container prose">
            <div class="grid grid-cols-2">
                <div class="col-span-1">
                    left
                </div>
                <div class="col-span-1">
                    <h2>GraphQL <3</h2>
                    <p>Developers can take advantage of GraphQL and build something amazing.</p>
                    <a href="">Discover GraphQL</a>
                </div>
            </div>
        </div>

        <div class="container prose">
            <div class="grid grid-cols-2">
                <div class="col-span-1">
                    <h2>Weather Integrations</h2>
                    <p>Take the precatuions nessessary and appropriate dress code for the day ahead.</p>
                </div>
                <div class="col-span-1">
                    right
                </div>
            </div>
        </div>

        <div class="container prose">
            <h2>Who Am I</h2>
            <p>
                An LIT Student completing fourth year of LIT Moylish, this final year project is one that would have saved me tons of frustration with the many years using such system, daily changes and the frequent downtime.</p>
        </div>

        {{-- @livewire('search.courses') --}}

    </div>

@endsection
