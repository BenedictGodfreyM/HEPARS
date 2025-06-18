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

        h1:first-of-type {
            border-top: 0px;
            margin-top: 0px;
            margin-bottom: 0px;
            padding-bottom: 0px;
        }
        
        h1 {
            width: 100%;
            text-align: center;
            color: #2c3e50;
            text-decoration: underline;
            text-transform: uppercase;
            font-size: 24px;
            margin-top: 4px;
            margin-bottom: 8px;
            border-top: 1px solid #eee;
            padding-bottom: 4px;
        }
        
        h2 {
            color: #2c3e50;
            font-size: 18px;
            margin-top: 30px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            table-layout: fixed; /* Ensures equal column widths */
            text-align: center;
        }

        th, td {
            width: 50%; /* Equal width for each column */
            padding: 12px 24px;
            word-wrap: break-word;
        }

        th {
            background-color: #f8f9fa;
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }

        td {
            border: none;
        }

        .recommendations {
            background-color: #f8f9fa;
            padding-left: .5rem !important;
            padding-bottom: .5rem !important;
            padding-right: .5rem !important;
            padding-top: .5rem !important;
        }

        .program:first-of-type{
            padding-top: 0;
        }
        
        .program {
            border-bottom: 1px solid #e9ecef;
            padding: 8px 0;
        }

        .program-details {
            color: #78838e;
            margin-left: 40px;
        }
        
        .program-title {
            color: #495057;
            display: block;
            font-weight: 600;
        }
        
        .program-duration {
            font-size: 12px;
            font-weight: 400;
            color: #6c757d !important;
            float: right !important;
        }
        
        .university, .location {
            font-style: italic;
        }
                
        .status, .affiliation {
            font-size: 14px;
        }

        .badge {
            display: inline-block;
            padding: .25em .4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
            color: #fff !important;
            background-color: #dc3545 !important;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }
        .apology_text {
            width: 100%;
            text-align: center;
            color: #ffc107 !important;
            font-size: 1.25rem;
            font-weight: 300;
            margin-top: 0;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <h1>ACSEE Results</h1>
    <table>
        <thead>
            <tr>
                <th>Subject</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            @foreach($student_results as $key => $entry)
            <tr>
                <td>{{ $entry['subject']['name'] }}</td>
                <td>{{ $entry['grade'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h1>Recommendations</h1>
    @if(count($recommendations['BasedOnselectedCareerField']) > 0)
    @if(count($recommendations['BasedOnOtherCareerFields']) > 0)
    <h2>Based on your Career Choice ({{ $recommendations['CareerField'] }})</h2>
    @endif
    <div class="recommendations">
        @foreach($recommendations['BasedOnselectedCareerField'] as $key => $recomendation)
        <div class="program">
            <div class="program-details">
                <span class="program-title">
                    {{ $recomendation->name }}
                    @if($recomendation->competition_scale === "High Competition")
                    <span class="badge">High Competition</span>
                    @endif
                    <span class="program-duration">{{ $recomendation->duration }} Years ({{ ($recomendation->duration * 2) }} Semesters)</span>
                </span>
                <div class="university">Offered by: <em>{{ $recomendation->institution->name }} ({{ $recomendation->institution->acronym }}).</em></div>
                <div class="location">This is a {{ strtolower($recomendation->institution->ownership) }} {{ strtolower($recomendation->institution->type) }}, located in {{ $recomendation->institution->location }}.</div>
                <div class="status">Institution Status: <em>{{ $recomendation->institution->accreditation_status }}</em></div>
                @if($recomendation->institution->affiliatedTo)
                <div class="affiliation">Affiliated To: <em>{{ $recomendation->institution->affiliatedTo->name }} ({{ $recomendation->institution->affiliatedTo->acronym }})</em></div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @else
        <p class="apology_text">
            Sorry!. We couldn't find programs you qualify in, based on your career choice <span style="font-style: italic;">({{ $recommendations['CareerField'] }})</span>.<br>
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
    <div class="recommendations">
        @foreach($recommendations['BasedOnOtherCareerFields'] as $key => $recomendation)
        <div class="program">
            <div class="program-details">
                <span class="program-title">
                    {{ $recomendation->name }}
                    @if($recomendation->competition_scale === "High Competition")
                    <span class="badge">High Competition</span>
                    @endif
                    <span class="program-duration">{{ $recomendation->duration }} Years ({{ ($recomendation->duration * 2) }} Semesters)</span>
                </span>
                <div class="university">Offered by: <em>{{ $recomendation->institution->name }} ({{ $recomendation->institution->acronym }}).</em></div>
                <div class="location">This is a {{ strtolower($recomendation->institution->ownership) }} {{ strtolower($recomendation->institution->type) }}, located in {{ $recomendation->institution->location }}.</div>
                <div class="status">Institution Status: <em>{{ $recomendation->institution->accreditation_status }}</em></div>
                @if($recomendation->institution->affiliatedTo)
                <div class="affiliation">Affiliated To: <em>{{ $recomendation->institution->affiliatedTo->name }} ({{ $recomendation->institution->affiliatedTo->acronym }})</em></div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @endif
</body>
</html>