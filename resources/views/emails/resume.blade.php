<!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Ekmatra</title>
</head>
<style type="text/css">
    body {
        margin: 0;
        padding: 0;
    }

    table {
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
    }

    td,
    th {
        border-collapse: collapse;
    }

    td a img {
        text-decoration: none;
        border: none;
    }
</style>

<body style="background: #F8F8F8;">
    <table cellpadding="0" cellspacing="0" align="center" width="800px" height="auto" style="border-collapse:collapse;border:1px solid #ddd;padding:50px;font-family:Tahoma, Geneva, sans-serif; font-size:14px;color:#060613;">
       
        <tr>
                <td style="padding:20px 38px 0px;font-size:16px;">
                    Name : {{ $data['name'] }}
                </td>
            </tr>

      

            <tr>
                <td style="padding:20px 38px 0px;font-size:16px;">
                    Email : {{ $data['email'] }}
                </td>
            </tr>
             <tr>
                <td style="padding:5px 38px 0px;font-size:16px;">
                    Phone : {{ $data['phone'] }}
                </td>
            </tr>

            <tr>
                <td style="padding:5px 38px 0px;font-size:16px;">
                    Description : {{ $data['description'] }}
                </td>
            </tr>

             <tr>
                <td style="padding:5px 38px 0px;font-size:16px;">
                    Resume : <a href="{{$data['pdf']}}" download>Download</a>
                </td>
            </tr>

         
        

           

           

            <tr>
                <td valign="top" style="background:#232735;padding:5px 0 5px 40px;">
                    <p style="font-family:Tahoma, Geneva, sans-serif; font-size:13px;margin:8px 0;color:#FFFFFF;text-align:center;">
                        © {{ date('Y') }} Ekmatra. All rights reserved.</p>
                </td>
            </tr>
    </table>
</body>

</html>