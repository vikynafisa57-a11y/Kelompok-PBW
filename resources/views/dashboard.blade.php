<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | SkillGap</title>
    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #101322;
            color: #f4f4fb;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        aside {
            width: 225px;
            padding: 28px 20px;
            background: #191d30;
        }

        aside h2 { color: #b7a6ff; }

        aside a {
            display: block;
            color: #c5c8d8;
            text-decoration: none;
            padding: 13px 10px;
            margin: 7px 0;
            border-radius: 8px;
        }

        aside a:hover { background: #30334c; }

        main {
            flex: 1;
            padding: 35px;
            min-width: 0;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(
                auto-fit, minmax(170px, 1fr)
            );
            gap: 18px;
            margin: 25px 0;
        }

        .card {
            padding: 22px;
            background: #1b2035;
            border: 1px solid #30364e;
            border-radius: 15px;
        }

        .muted { color: #a6acc2; }

        .number {
            font-size: 30px;
            font-weight: bold;
            margin: 12px 0;
        }

        .bar {
            height: 8px;
            background: #343951;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 12px;
        }

        .fill {
            height: 100%;
            background: #a78bfa;
            border-radius: 10px;
        }

        .action {
            display: inline-block;
            padding: 12px 17px;
            margin-top: 15px;
            border-radius: 8px;
            color: #111322;
            background: #b7a6ff;
            text-decoration: none;
            font-weight: bold;
        }

        @media (max-width: 650px) {
            .layout { display: block; }
            aside { width: 100%; }
            main { padding: 20px; }
        }
    </style>
</head>
<body>
<div class="layout">
    <aside>
        <h2>SkillGap.</h2>
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('assessment.index') }}">Assessment</a>
        <a href="{{ route('skills.index') }}">Skill Map</a>
        <a href="{{ route('roadmap.index') }}">Roadmap</a>
        <a href="{{ route('progress.index') }}">My Progress</a>
    </aside>

    <main>
        <p class="muted">YOUR PERSONAL SKILL SPACE</p>

        <h1>Welcome back, {{ auth()->user()->name }}!</h1>
        <p class="muted">
            Small progress today, stronger skills tomorrow.
        </p>

        <section class="cards">
            <div class="card">
                <p class="muted">Overall Skill Score</p>
                <div class="number">{{ $overallScore }}%</div>
                <div class="bar">
                    <div class="fill"
                         style="width: {{ $overallScore }}%">
                    </div>
                </div>
            </div>

            <div class="card">
                <p class="muted">Assessed Skills</p>
                <div class="number">
                    {{ $latestResults->count() }}
                </div>
                <p class="muted">Skills with assessment results</p>
            </div>

            <div class="card">
                <p class="muted">Target Career</p>
                <div class="number" style="font-size: 22px">
                    {{ $career?->name ?? 'Not selected' }}
                </div>
                <p class="muted">Your career direction</p>
            </div>
        </section>

        <section class="card">
            <h2>Your Skill Overview</h2>

            @forelse ($latestResults as $result)
                <p>
                    {{ $result->skill->name }}
                    <strong style="float: right">
                        {{ $result->score }}%
                    </strong>
                </p>

                <div class="bar">
                    <div class="fill"
                         style="width: {{ max(0, min(100, $result->score)) }}%">
                    </div>
                </div>
            @empty
                <p class="muted">
                    You haven't completed an assessment yet.
                </p>
            @endforelse

            <a class="action"
               href="{{ route('assessment.index') }}">
                Start Assessment →
            </a>
        </section>
    </main>
</div>
</body>
</html>