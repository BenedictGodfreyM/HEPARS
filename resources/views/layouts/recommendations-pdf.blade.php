<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommended Programs</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        h1 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        
        h2 {
            color: #2c3e50;
            font-size: 18px;
            margin-top: 30px;
            margin-bottom: 15px;
        }
        
        .program {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            border-left: 4px solid #3498db;
        }
        
        .title-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }
        
        .program-title {
            font-weight: bold;
            font-size: 16px;
        }
        
        .program-duration {
            color: #7f8c8d;
            font-size: 14px;
        }
        
        .university {
            font-style: italic;
            margin-bottom: 5px;
        }
        
        .location {
            color: #7f8c8d;
            font-size: 14px;
            margin-bottom: 10px;
        }
        
        .status {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .affiliation {
            font-size: 14px;
            margin-bottom: 10px;
        }
        
        .link {
            color: #3498db;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
            margin-top: 5px;
        }
        
        .link:hover {
            text-decoration: underline;
        }
        
        .badge {
            display: inline-block;
            padding: 3px 8px;
            font-size: 12px;
            font-weight: 600;
            line-height: 1;
            color: #d62c1a;
            background-color: #fde8e6;
            border-radius: 12px;
            border: 1px solid #f8c9c5;
            white-space: nowrap;
            margin-left: 8px;
        }
        
        .export-btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 20px;
            display: inline-flex;
            align-items: center;
        }
        
        .export-btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <h1>We recommend these programs...</h1>
    @if(count($recommendations['BasedOnselectedCareerField']) > 0)
    @if(count($recommendations['BasedOnOtherCareerFields']) > 0)
    <h2>Based on your Career Choice</h2>
    @endif
    @foreach($recommendations['BasedOnselectedCareerField'] as $key => $recomendation)
    <div class="program">
        <div class="title-container">
            <div class="program-title">
                {{ $recomendation->name }}
                @if($recomendation->competition_scale === "High Competition")
                <span class="badge">High Competition</span>
                @endif
            </div>
            <div class="program-duration">{{ $recomendation->duration }} Years ({{ ($recomendation->duration * 2) }} Semesters)</div>
        </div>
        <div class="university">Offered by: <em>{{ $recomendation->institution->name }} ({{ $recomendation->institution->acronym }}).</em></div>
        <div class="location">This is a {{ strtolower($recomendation->institution->ownership) }} {{ strtolower($recomendation->institution->type) }}, located in {{ $recomendation->institution->location }}.</div>
        <div class="status">Institution Status: <em>{{ $recomendation->institution->accreditation_status }}</em></div>
        @if($recomendation->institution->affiliatedTo)
        <div class="affiliation">Affiliated To: <em>{{ $recomendation->institution->affiliatedTo->name }} ({{ $recomendation->institution->affiliatedTo->acronym }})</em></div>
        @endif
    </div>
    @endforeach
    @else
        <p>
            Sorry!. We couldn't find programs you qualify in, based on your career choice.<br>
            @if(count($recommendations['BasedOnOtherCareerFields']) > 0)
                However, you qualify for programs from other fields.<br> 
                Check out the list below:
            @else
                Try selecting a different career.
            @endif
        </p>
    @endif
    @if(count($recommendations['BasedOnOtherCareerFields']) > 0)
    @if(count($recommendations['BasedOnselectedCareerField']) > 0)
    <h2>Programs from other career fields</h2>
    @endif
    @foreach($recommendations['BasedOnOtherCareerFields'] as $key => $recomendation)
    <div class="program">
        <div class="title-container">
            <div class="program-title">
                {{ $recomendation->name }}
                @if($recomendation->competition_scale === "High Competition")
                <span class="badge">High Competition</span>
                @endif
            </div>
            <div class="program-duration">{{ $recomendation->duration }} Years ({{ ($recomendation->duration * 2) }} Semesters)</div>
        </div>
        <div class="university">Offered by: <em>{{ $recomendation->institution->name }} ({{ $recomendation->institution->acronym }}).</em></div>
        <div class="location">This is a {{ strtolower($recomendation->institution->ownership) }} {{ strtolower($recomendation->institution->type) }}, located in {{ $recomendation->institution->location }}.</div>
        <div class="status">Institution Status: <em>{{ $recomendation->institution->accreditation_status }}</em></div>
        @if($recomendation->institution->affiliatedTo)
        <div class="affiliation">Affiliated To: <em>{{ $recomendation->institution->affiliatedTo->name }} ({{ $recomendation->institution->affiliatedTo->acronym }})</em></div>
        @endif
    </div>
    @endforeach
    @endif
</body>
</html>