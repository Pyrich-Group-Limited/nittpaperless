<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
/*! Email Template */
.email-wraper {
  background: #f5f6fa;
  font-size: 14px;
  line-height: 22px;
  font-weight: 400;
  color: #8094ae;
  width: 100%;
}
.email-wraper a {
  color: #6576ff;
  word-break: break-all;
}
.email-wraper .link-block {
  display: block;
}
.email-ul {
  margin: 5px 0;
  padding: 0;
}
.email-ul:not(:last-child) {
  margin-bottom: 10px;
}
.email-ul li {
  list-style: disc;
  list-style-position: inside;
}
.email-ul-col2 {
  display: flex;
  flex-wrap: wrap;
}
.email-ul-col2 li {
  width: 50%;
  padding-right: 10px;
}
.email-body {
  width: 96%;
  max-width: 620px;
  margin: 0 auto;
  background: #ffffff;
}
.email-success {
  border-bottom: #1ee0ac;
}
.email-warning {
  border-bottom: #f4bd0e;
}
.email-btn-sm {
  background: #6576ff;
  border-radius: 4px;
  color: #ffffff !important;
  display: inline-block;
  font-size: 13px;
  font-weight: 600;
  line-height: 34px;
  text-align: center;
  text-decoration: none;
  text-transform: uppercase;
  padding: 0 30px;
}
.email-btn-sm {
  line-height: 28px;
}
.email-header, .email-footer {
  width: 100%;
  max-width: 620px;
  margin: 0 auto;
}
.email-logo {
  height: 40px;
}
.email-title {
  font-size: 13px;
  color: #6576ff;
  padding-top: 12px;
}
.email-heading {
  font-size: 18px;
  color: #6576ff;
  font-weight: 600;
  margin: 0;
  line-height: 1.4;
}
.email-heading-sm {
  font-size: 24px;
  line-height: 1.4;
  margin-bottom: 0.75rem;
}
.email-heading-s1 {
  font-size: 20px;
  font-weight: 400;
  color: #526484;
}
.email-heading-s2 {
  font-size: 16px;
  color: #526484;
  font-weight: 600;
  margin: 0;
  text-transform: uppercase;
  margin-bottom: 10px;
}
.email-heading-s3 {
  font-size: 18px;
  color: #6576ff;
  font-weight: 400;
  margin-bottom: 8px;
}
.email-heading-success {
  color: #1ee0ac;
}
.email-heading-warning {
  color: #f4bd0e;
}
.email-note {
  margin: 0;
  font-size: 13px;
  line-height: 22px;
  color: #8094ae;
}
.email-copyright-text {
  font-size: 13px;
}
.email-social li {
  display: inline-block;
  padding: 4px;
}
.email-social li a {
  display: inline-block;
  height: 30px;
  width: 30px;
  border-radius: 50%;
  background: #ffffff;
}
.email-social li a img {
  width: 30px;
}

@media (max-width: 480px) {
  .email-preview-page .card {
    border-radius: 0;
    margin-left: -20px;
    margin-right: -20px;
  }
  .email-ul-col2 li {
    width: 100%;
  }
}
    </style>
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="content-page wide-md m-auto">
                                    <div class="nk-block">
                                        <div class="card card-bordered" style="padding: 20px;">
                                            <div class="card-inner">
                                                <table class="email-wraper">
                                                    <tr>
                                                        <td class="py-5">
                                                            <table class="email-header">
                                                                <tbody>
                                                                    <tr>

                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <table style="padding: 20px; border-radius:5px;" class="email-body">
                                                                <tbody>
                                                                    <td align="center" class="text-center pb-4">
                                                                        <a href="#"><img class="email-logo" src="https://nacomns.fra1.digitaloceanspaces.com/kasuwan-kano/assets/images/mail/ncc-logo.png" alt="logo"></a>
                                                                    </td>
                                                                    <tr>
                                                                        <td class="p-3 p-sm-5">
                                                                            <p><strong>Hello {{ $mailcontent->receiver->surname }}</strong>,</p>
                                                                            <p>{!! $mailcontent->mail_body !!}</p>
                                                                            <p class="mt-4"><br> Regards<br>Nigeria Communications Commission</p>
                                                                        </td>

                                                                    </tr>
                                                                    <td align="center" class="text-center pt-4">
                                                                        <hr><p align="center" class="email-copyright-text">Copyright © 2023 NCC. All rights reserved. <br>Enterprise Head Risk Managementment</p>
                                                                    </td>
                                                                </tbody>
                                                            </table>

                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div><!-- .nk-block -->
                                </div><!-- .content-page -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->

            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- JavaScript -->
    <script src="{{ asset('assets/js/bundle.js?ver=3.1.3') }}"></script>
    <script src="{{ asset('assets/js/scripts.js?ver=3.1.3') }}"></script>
</body>
</html>
