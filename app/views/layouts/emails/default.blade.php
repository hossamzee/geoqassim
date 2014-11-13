<!DOCTYPE HTML>
<html style="direction: rtl;">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body style="background-color: #f1f1f1; direction: rtl;">

  <table border="0" style="width: 620px; margin-left: auto; margin-right: auto;">

    <!-- Top Info -->
    <tr>
      <td style="padding: 10px; border-bottom: 1px solid #ccc; color: #666; font-family: arial; font-size: 14px;">
        الرسالة قادمة من @yield('name') &lt;@yield('from')&gt;
      </td>
    </tr>

    <!-- Logo -->
    <tr>
      <td style="padding: 30px; text-align: center;">
          <a href="{{ url() }}">
            <img src="{{ url('assets/images/email-logo.png') }}" style="border: 0;" />
          </a>
      </td>
    </tr>

    <!-- Content -->
    <tr>
      <td>
        <table border="0" style="border: 1px solid #ccc; padding: 20px; width: 100%; background-color: #fff;">
          <tr>
            <td>
              <h3 style="font-family: arial; font-size: 20px; font-weight: bold;">@yield('subject')</h3>
              <p style="font-family: arial; font-size: 16px;">@yield('content')</p>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <!-- Footer -->
    <tr>
      <td style="padding: 30px; text-align: center; color: #666; font-family: arial; font-size: 14px;">
        موقع قسم الجغرافيا في جامعة القصيم - {{ url() }}
      </td>
    </tr>

  </table>
</body>
</html>
