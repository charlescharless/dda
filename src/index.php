<?php
    include("../includes/functions.php");
    include("../includes/dbconnect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Certificate Verification | Dreams Driving Academy Inc.</title>
<link rel="icon" type="image" href="../img/dda_black.png">
<style>
  :root {
    --navy: #10233e;
    --blue: #1d4ed8;
    --gold: #d4a017;
    --green: #1a7d3c;
    --red: #b3261e;
    --gray-bg: #f4f6f9;
    --border: #e2e6ec;
  }
  * { box-sizing: border-box; }
  body {
    margin: 0;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    background: var(--gray-bg);
    color: #1f2933;
  }
  header {
    background: #FEDA08;
    color: #fff;
    padding: 28px 20px;
    text-align: center;
  }
  header .badge {
    display: inline-block;
    width: 46px;
    height: 46px;
    line-height: 46px;
    border-radius: 50%;
    background: var(--gold);
    color: var(--navy);
    font-weight: 700;
    margin-bottom: 10px;
  }
  header h1 {
    color: #000000;
    margin: 0;
    font-size: 22px;
    letter-spacing: 0.3px;
  }
  header p {
    color: #000000;
    margin: 6px 0 0;
    font-size: 14px;
  }
  main {
    max-width: 560px;
    margin: -15px auto 40px;
    padding: 0 20px;
  }
  .card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 28px 24px;
    box-shadow: 0 10px 30px rgba(16, 35, 62, 0.08);
  }
  .card h2 {
    margin-top: 0;
    font-size: 17px;
    color: var(--navy);
  }
  label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #445069;
    margin: 16px 0 6px;
  }
  input[type=text] {
    width: 100%;
    padding: 11px 12px;
    border: 1px solid #c9d2e0;
    border-radius: 8px;
    font-size: 15px;
  }
  input[type=text]:focus {
    outline: none;
    border-color: var(--blue);
    box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.15);
  }
  button {
    width: 100%;
    margin-top: 22px;
    padding: 13px;
    border: none;
    border-radius: 8px;
    background: var(--blue);
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
  }
  button:hover { background: #1743ab; }
  .hint {
    font-size: 12px;
    color: #6b7688;
    margin-top: 8px;
  }
  .result {
    margin-top: 24px;
    border-radius: 10px;
    padding: 18px 18px;
    font-size: 14px;
  }
  .result.valid   { background: #eafaf0; border: 1px solid #b7e6c6; }
  .result.expired { background: #fff6e6; border: 1px solid #f1d998; }
  .result.revoked,
  .result.invalid { background: #fdecec; border: 1px solid #f3bcb8; }
  .result h3 {
    margin: 0 0 10px;
    font-size: 15px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .result.valid h3   { color: var(--green); }
  .result.expired h3 { color: #8a5a00; }
  .result.revoked h3,
  .result.invalid h3 { color: var(--red); }
  .details dt { font-weight: 600; color: #445069; font-size: 12px; margin-top: 8px; }
  .details dd { margin: 2px 0 0; font-size: 14px; }
  footer {
    text-align: center;
    font-size: 12px;
    color: #8a93a6;
    padding-bottom: 30px;
  }
  img {
    width: 150px;
  }
</style>
</head>
<body>

<header>
  <img src="../img/dda_black.png">
  <h1>Certificate Verification Portal</h1>
</header>

<main>
  <div class="card">
    <?php
      $name = getTableRow("Name", "info_list", "WHERE ID = '".$_GET['id']."'");
      $course = getTableRow("Course", "info_list", "WHERE ID = '".$_GET['id']."'");
      $cert_no = getTableRow("CertificateNumber", "info_list", "WHERE ID = '".$_GET['id']."'");
      $acc_no = getTableRow("AccreditationNumber", "info_list", "WHERE ID = '".$_GET['id']."'");
      $date_issued = getTableRow("DateIssued", "info_list", "WHERE ID = '".$_GET['id']."'");
      $validity = getTableRow("ValidUntil", "info_list", "WHERE ID = '".$_GET['id']."'");

      $new_date_issued = new DateTime($date_issued);
      $di = $new_date_issued->format('F j, Y');
      $new_validity = new DateTime($validity);
      $new_validity_date = $new_validity->format('F j, Y');
    ?>
    <p style="font-size: 15px; margin: 0; margin-bottom: 2px;">Name: <span style="font-weight: 700;"><?php echo $name; ?></span></p>
    <p style="font-size: 15px; margin: 0; margin-bottom: 2px;">Course: <span style="font-weight: 700;"><?php echo $course; ?></span></p>
    <p style="font-size: 15px; margin: 0; margin-bottom: 2px;">Certificate Number: <span style="font-weight: 700;"><?php echo $cert_no; ?></span></p>
    <p style="font-size: 15px; margin: 0; margin-bottom: 2px;">Date Issued: <span style="font-weight: 700;"><?php echo $di; ?></span></p>
    <p style="font-size: 15px; margin: 0; margin-bottom: 2px;">Accreditation Number: <span style="font-weight: 700;"><?php echo $acc_no; ?></span></p>
    <p style="font-size: 15px; margin: 0; margin-bottom: 2px;">Validity: <span style="font-weight: 700;"><?php echo $di." to ".$new_validity_date; ?></span></p>
    <br>
    <p style="font-size: 15px; margin: 0; margin-bottom: 2px;">This page certifies that <span style="font-weight: 700;"><?php echo $name; ?></span> completed the course titled <span style="font-weight: 700;"><?php echo $course; ?></span> on <span style="font-weight: 700;"><?php echo $di; ?></span></p>
  </div>
</main>

<footer>
  &copy; <?= date('Y') ?> Dreams Driving Academy Inc.
</footer>

</body>
</html>
