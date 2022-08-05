<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>
        Result
    </title>
    <style type="text/css">
        .fil {
            background-color: #9F9;
            color: #000;
        }

        .fil2 {
            background-color: #FF6;
            color: #000;
        }

        td {
            border: solid 1px
        }

        table {
            width: 100%;
        }

        .style1 {
            border-style: none;
            border-color: inherit;
            border-width: medium;
            width: 100%;
            height: 100px;
        }

        .style2 {
            font-weight: bold;
            border: NONE;
        }

        td.datacellone {
            border: NONE;
            background-color: #FFC;
            color: black;
        }

        td.datacelltwo {
            border: NONE;
            background-color: #fff;
            color: black;
        }

        .style3 {
            width: 72%;
        }

    </style>
</head>

<body>
    <form method="post" action="" id="form1" style="background-position: center center; font-family: Arial, Helvetica, Verdana, sans-serif; font-size: 12px; color: #666666; background-image: url(&#39;yctwatermark.jpg&#39;); background-repeat: no-repeat;">
       
        <script type="text/javascript">
            //<![CDATA[
            var theForm = document.forms['form1'];
            if (!theForm) {
                theForm = document.form1;
            }

            function __doPostBack(eventTarget, eventArgument) {
                if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
                    theForm.__EVENTTARGET.value = eventTarget;
                    theForm.__EVENTARGUMENT.value = eventArgument;
                    theForm.submit();
                }
            }
            //]]>

        </script>


        <div class="aspNetHidden">

            <input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="D5C1F7C7" />
            <input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION"
                value="/wEdAANSMpXlKL+NzZ7qRHuRZ5Wp5rm+InKeU+5cTrgrrVINqLU3zaTs9Ah+Lyp4AX88QyGFRgzijOemUbqoye78V7pXnYP8llZUkj1YM7u4t2q5Ug==" />
        </div>
        <div align="center">
            {{-- <div><img style="width: 200px;" src="/images/logo.png" /></div> --}}
            <div style="text-align:left; height:auto; width:900px">
                <div style="text-align:center; font-weight:bold; width:100%; font-size: large;">STATEMENT OF RESULT
                </div><br />
                <span id="LblName" style="font-size:Small;font-weight:bold;">{{ strtoupper($student->user->surname) }}, {{ strtoupper($student->user->name) }} {{ strtoupper($student->user->middle_name) }}</span> <br />
                <span id="LblMatricno2" style="font-size:Small;font-weight:bold;">{{ $student->user->matric }}</span> <br />
                <span id="LblDept" style="font-size:Small;font-weight:bold;">{{ strtoupper($student->department->name) }}</span>
                <br />
                <span id="Lblschool" style="font-size:Small;font-weight:bold;">{{ strtoupper($student->faculty->name) }}</span> <br />
                <span id="LblSession" style="font-size:Small;font-weight:bold;">{{ $student->program }}, {{ $student->level . '00 LEVEL ' . $student->semester }} SEMESTER <br>{{ $result->academic_session }} ACADEMIC
                    SESSION</span> <br />
                <hr />


            </div>
            <div style="width:900px; border:solid 1px; height :auto">
                <span id="Lblcontent1">
                    <table cellpadding='3' cellspacing='2'>
                        <tr style='background-color:#9F9; color:#000; border:1px solid #000; font-weight:bold;'>
                            <td> COURSE CODE </td>
                            <td> COURSE TITLE</td>
                            <td> UNIT(S) </td>
                            <td> GRADE POINT </td>
                            <td> GRADE </td>
                        </tr>
                        @foreach($results as $r)
                        <tr>
                            <td class="datacellone">{{ $r->code }}</td>
                            <td class="datacellone">{{ $r->title }}</td>
                            <td class="datacellone">{{ $r->units }}</td>
                            <td class="datacellone">{{ app('App\Http\Controllers\Controller')->getGradeAlphabet($r->score)['gp'] }}</td>
                            <td class="datacellone">{{ app('App\Http\Controllers\Controller')->getGradeAlphabet($r->score)['grade'] }}</td>
                        </tr>
                        @endforeach
                    </Table>
                </span>
            </div>
            <hr />
            <div style="width:900px; height :400px">


                <table class="style1">
                    <tr>
                        <td style="text-align:left; width:50%  " valign="top" class="style2">
                            CURRENT<br />
                            <table cellpadding="5" cellspacing="2">
                                <tr>
                                    <td class="fil">
                                        Total unit(s)</td>
                                    <td>
                                        <span id="lblUnit1">{{ array_sum(array_column($results, 'units')) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fil">
                                        Total point (s) </td>
                                    <td>
                                        <span id="LblPoint1">{{ number_format($result->weighted_point, 2) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fil">
                                        Grade Point Avarage</td>
                                    <td>
                                        <span id="Lblgpa1">{{ number_format($result ->gpa, 2) }}</span>
                                    </td>
                                </tr>
                            </table>


                        </td>
                        <td style="text-align:left; width:50%  " valign="top" class="style2">
                            CUMMULATIVE<br />
                            <table cellpadding="5" cellspacing="2">
                                <tr>
                                    <td class="fil2">
                                        Cummulative CGPA</td>
                                    <td>
                                        <span id="Lblgpa2">{{ number_format($result->cgpa, 2) }}</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <div style="text-align:left">
                    <br />
                    <br />
                
                    <div style="width:100%; text-align:center; width: 100%; height:200px;" align="center">
                        <table style="width : 100%;  ">
                            <tr>
                                <td style="width : 30%; border-style:none;  ">

                                </td>

                                <td
                                    style="width : 50%; border-style:none;  border-style:none;  background:url('stamp2.png');  background-size: 265px; background-repeat: no-repeat; background-position: left center;">
                                    <br /><br />
                                    <img src="REGISTRAR_SIG.png" style="opacity:50" /><br />
                                    .................................................................<br />
                                    Registrar
                                    <br /><strong>******ANY ALTERATION WHATSOVER RENDERS THIS RESULT
                                        INVALID*******</strong><br />
                                    <br /><span>PRINTED (Saturday, July 16 2022)</span><br />
                                    <a id="lnkclose" href="javascript:__doPostBack(&#39;lnkclose&#39;,&#39;&#39;)">CLOSE</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a onclick="javascript:window.print();" id="LinkButton1"
                                        href="javascript:__doPostBack(&#39;LinkButton1&#39;,&#39;&#39;)">PRINT</a>

                                </td>

                                <td style="width : 15% ; border-style:none ">

                                </td>

                            </tr>
                        </table>

                    </div>
                </div>
            </div>

        </div>


    </form>
</body>

</html>

