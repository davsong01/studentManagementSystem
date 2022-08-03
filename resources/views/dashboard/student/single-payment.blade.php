<head>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <style type="text/css">
        body {
            font-family: "Source Sans Pro", sans-serif;
        }

        table,
        th,
        td {
            border: 1px solid #060;
        }

        #printDiv {
            background;

        }

        .bio_print {
            color: #006600;
            font-size: 12px;
            padding: 5px 5px;
        }

        blockquote.emph {
            padding: 10px 10px;
            margin: 0px 0px 0px;
            font-size: 17.5px;
            color: #006600;
            border-left: 10px solid #006600;
            border-left-color: #006600;
        }

    </style>
</head>

<body oncontextmenu="return false" onkeydown="return false;" class="panel-body" id="printDiv">
    <div class="vertical-align-wrap">
        <div class="vertical-align-middle">
            <div class="content">
                <div>
                    <div class="print" style="">

                        <div class="panel-body">
                            <table style="width:800px; border: 0px; margin-bottom:30px;" align="center" id="printDiv">
                                <tr>
                                    {{-- <td align="center" style="border: 0px; padding-left:50px;">
                                        <img style="width: 200px;" src="{{ asset('images/logo.png') }}" alt="Logo">
                                    </td> --}}
                                </tr>
                            </table>
                            <table style="width:800px; border: 0px; margin-bottom:30px;" align="center">

                                <tr>
                                    <td style="border: 0px;">
                                        <table style="border: 0px;">
                                            <tr>
                                                <blockquote class="emph"><b>PAYMENT HISTORY:</b></blockquote>
                                            </tr>
                                            <tr>
                                                <td style="border: 0px; padding-right:20px;">
                                                    <li class="bio_print">PAYMENT:
                                                </td>
                                                <td style="border: 0px;"><b class="bio_print">{{ strtoupper($payment->name) }}</b>
                                                    </li>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border: 0px; padding-right:20px;">
                                                    <li class="bio_print">NAME:
                                                </td>
                                                <td style="border: 0px;"><b class="bio_print">{{ strtoupper($payment->user->name) . ' ' . strtoupper($payment->user->middle_name) . ' '. strtoupper($payment->user->surname )}}</b>
                                                    </li>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border: 0px; padding-right:20px; ">
                                                    <li class="bio_print">MATRIC NO:
                                                </td>
                                                <td style="border: 0px;"><b class="bio_print">{{ $payment->user->matric }}</b></li>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border: 0px; padding-right:20px;">
                                                    <li class="bio_print">GENDER:
                                                </td>
                                                <td style="border: 0px;"><b class="bio_print">{{ strtoupper($payment->student->gender) }}</b></li>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border: 0px; padding-right:20px;">
                                                    <li class="bio_print">DATE:
                                                </td>
                                                <td style="border: 0px;"><b class="bio_print">{{ $payment->created_at }}</b></li>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td align="right" style="border: 0px;">
                                        <img style="width:200px" src="{{ asset('/images/profile/' . $payment->user->profile_picture ) }}"
                                            alt="{{ $payment->user->matric }}">
                                    </td>
                                </tr>
                            </table>

                            <table style="width:800px; border: 1px solid #060; margin-top:50px; color:#060"
                                align="center">

                                <tr>
                                    <td align="center"><b>S/No.</b></td>
                                    <td align="center"><b>FEE TYPE</b></td>
                                    <td align="center"><b>ACADEMIC SESSION</b></td>
                                    <td align="center"><b>VALUE</b></td>
                                    <td align="center"><b>DATE</b></td>
                                    <td align="center"><b>STATUS</b></td>
                                </tr>

                                <tr>
                                    <td class='bio' align='center'>1</td>
                                    <td class='bio' style='padding-left:10px;'>{{ strtoupper($payment->name) }}</td>
                                    <td class='bio' align='center'>{{ $payment->session }}</td>
                                    <td class='bio' align='center'>&#8358;{{ number_format($payment->amount) }}</td>
                                    <td class='bio' align='center'>{{ $payment->created_at }}</td>
                                    <td class='bio' align='center'>{{ strtoupper($payment->status) }}</td>
                                   
                                </tr>
                            </table>

                            <table style="width:800px; border: 0px; margin-top:50px; color:#060;" align="center">
                                <tr>
                                    <td align="center" style="border: 0px;" class="col-md-4">
                                        <span><small>DATE PRINTED : {{ date('Y-m-d h:i:s') }}</small></span>
                                        <!---LOCAL MACHINE-->
                                    </td>
                                </tr>
                            </table>
                            <table style="width:800px; border: 0px; margin-top:20px; color:#060;" align="center">
                                <tr>
                                    <td align="center" style="border: 0px;" class="col-md-4">

                                    </td>
                                    <td align="center" style="border: 0px;" class="col-md-4">
                                        <button class="btn btn-default btn-block" id="print"
                                            onclick="window.print(this)">PRINT</button>
                                        <a id="lnkclose" href="javascript:__doPostBack(&#39;lnkclose&#39;,&#39;&#39;)">CLOSE</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </td>
                                    <td align="right" style="border: 0px;" class="col-md-4">

                                    </td>
                                </tr>
                            </table>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/portalplus/ajax/logout.js"></script>
    <script src="/portalplus/assets/js/jquery.slimscroll.min.js"></script>
    <script src="/portalplus/assets/js/popper.min.js"></script>
    <script src="/portalplus/assets/js/bootstrap.min.js"></script>
    <script src="/portalplus/assets/js/holder.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });

    </script>

</body>

</html>
