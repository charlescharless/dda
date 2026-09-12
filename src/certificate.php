<?php
    include("../includes/functions.php");
    include("../includes/dbconnect.php");
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Record New Certificate | Dreams Driving Academy Inc.</title>
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
    img {
    width: 150px;
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
  header h1 { margin: 0; font-size: 22px; letter-spacing: 0.3px; color: #000000; }
  header p { margin: 6px 0 0; font-size: 14px; color: #000000; }
  main {
    max-width: 640px;
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
  .card h2 { margin-top: 0; font-size: 17px; color: var(--navy); }
  .card > p { font-size: 14px; color: #5a6478; margin-bottom: 0; }
  .row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0 16px;
  }
  @media (max-width: 480px) {
    .row { grid-template-columns: 1fr; }
    .btn-row { flex-direction: column; }
  }
  label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #445069;
    margin: 16px 0 6px;
  }
  input[type=text], input[type=date] {
    width: 100%;
    padding: 11px 12px;
    border: 1px solid #c9d2e0;
    border-radius: 8px;
    font-size: 15px;
    font-family: inherit;
  }
  input:focus {
    outline: none;
    border-color: var(--blue);
    box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.15);
  }
  .btn-row {
    display: flex;
    gap: 12px;
    align-items: stretch;
  }
  .btn-row > * {
    flex: 1;
  }
  a, button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 44px;
    margin-top: 24px;
    padding: 0 13px;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    box-sizing: border-box;
    line-height: 1;
  }
  a {
    background: transparent;
    color: var(--blue);
    border: 1.5px solid var(--blue);
  }
  a:hover {
    background: var(--blue);
    color: #fff;
  }
  button {
    background: var(--blue);
    color: #fff;
    border: 1.5px solid var(--blue);
  }
  button:hover {
    background: #1743ab;
  }
  .banner {
    margin-top: 20px;
    border-radius: 10px;
    padding: 16px 18px;
    font-size: 14px;
  }
  .banner.success { background: #eafaf0; border: 1px solid #b7e6c6; color: var(--green); }
  .banner.error   { background: #fdecec; border: 1px solid #f3bcb8; color: var(--red); }
  .banner ul { margin: 6px 0 0; padding-left: 18px; }
  footer {
    text-align: center;
    font-size: 12px;
    color: #8a93a6;
    padding-bottom: 30px;
  }  .btn-row a.link-plain {
    background: transparent;
    border: none;
    color: var(--blue);
    text-decoration: none;
  }
  .btn-row a.link-plain:hover {
    background: transparent;
    color: var(--blue);
    text-decoration: underline;
  }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<header>
  <img src="../img/dda_black.png">
  <h1>Certificate Verification Portal</h1>
</header>

<main>
  <div class="card">
    <h2>Record a New Certificate</h2>
    <p>Fill in the details below to save the certificate informations. Once saved, the verification page can be viewed.</p>

    <form method="POST">
      <label for="name">Name</label>
      <input type="text" id="name" name="name" placeholder="e.g. Rey Vincent Maligalig" value="<?php if (isset($_GET['id'])) { echo getTableRow("name", "info_list", "WHERE ID = '".$id."'"); } ?>" required>

      <label for="course">Course</label>
      <input type="text" id="course" name="course" placeholder="e.g. Practical Driving Course (PDC)" value="<?php if (isset($_GET['id'])) { echo getTableRow("Course", "info_list", "WHERE ID = '".$id."'"); } ?>" required>

      <div class="row">
        <div>
          <label for="cert_number">Certificate Number</label>
          <input type="text" id="cert_number" name="cert_number" placeholder="e.g. DDA-2026-12345" value="<?php if (isset($_GET['id'])) { echo getTableRow("CertificateNumber", "info_list", "WHERE ID = '".$id."'"); } ?>" required>
        </div>
        <div>
          <label for="accreditation_number">Accreditation Number</label>
          <input type="text" id="accreditation_number" name="accreditation_number" placeholder="e.g. DS-2020-00023" value="<?php if (isset($_GET['id'])) { echo getTableRow("AccreditationNumber", "info_list", "WHERE ID = '".$id."'"); } ?>" required>
        </div>
      </div>

      <div class="row">
        <div>
          <label for="date_issued">Date Issued</label>
          <input type="date" id="date_issued" name="date_issued" value="<?php if (isset($_GET['id'])) { echo getTableRow("DateIssued", "info_list", "WHERE ID = '".$id."'"); } ?>" required>
        </div>
        <div>
          <label for="validity">Valid Until</label>
          <input type="date" id="validity" name="validity" value="<?php if (isset($_GET['id'])) { echo getTableRow("ValidUntil", "info_list", "WHERE ID = '".$id."'"); } ?>" required>
        </div>
      </div>
      <div class="btn-row">
        <a href="list.php" class="link-plain">
          <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M9 8h10M9 12h10M9 16h10M4.99 8H5m-.02 4h.01m0 4H5"/>
          </svg>&nbsp; View List
        </a>
        <a href="certificate.php">
          <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
          </svg>&nbsp; New
        </a>        
        <button type="submit" id="submit" name="submit">
          <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M11 16h2m6.707-9.293-2.414-2.414A1 1 0 0 0 16.586 4H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V7.414a1 1 0 0 0-.293-.707ZM16 20v-6a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v6h8ZM9 4h6v3a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V4Z"/>
          </svg>&nbsp; Save
        </button>
      </div>


    </form>
    <?php
      include("../includes/dbconnect.php");
      if (isset($_POST['submit'])) 
      {
        $name = addslashes($_POST['name']);
        $course = addslashes($_POST['course']);
        $cert_number = addslashes($_POST['cert_number']);
        $accreditation_number = addslashes($_POST['accreditation_number']);
        $date_issued = addslashes($_POST['date_issued']);
        $validity = addslashes($_POST['validity']);

        if (isset($_GET['id'])) 
        {
          $sqlUpdate = "UPDATE info_list SET 
                  Name = '".$name."', 
                  Course = '".$course."',
                  CertificateNumber = '".$cert_number."',
                  AccreditationNumber = '".$accreditation_number."',
                  DateIssued = '".$date_issued."',
                  ValidUntil = '".$validity."'
                  WHERE ID = '".$id."'";

          if ($conn->query($sqlUpdate) === TRUE) {
              echo "<script type='text/javascript'>
                  swal.fire({
                      confirmButtonColor: '#1E40AF',
                      title: 'Success',
                      text: 'Successfully updated information',
                      icon: 'success',
                      button: 'Ok',
                  }).then(function() {
                      window.location = 'certificate.php?id=".$id."';
                  });
                  </script>";
          } else {
              echo "<script type='text/javascript'>
                  swal.fire({
                      confirmButtonColor: '#1E40AF',
                      title: 'Success',
                      text: 'Server error. Please contact your system administrator',
                      icon: 'success',
                      button: 'Ok',
                  });
                  </script>";
          }
        } 
        else 
        {
          $sqlInsertInfo = "INSERT INTO info_list
          (Name, Course, CertificateNumber, AccreditationNumber, DateIssued, ValidUntil) 
          VALUES 
          ('".$name."', '".$course."', '".$cert_number."', '".$accreditation_number."', '".$date_issued."', '".$validity."')";
          if ($conn->query($sqlInsertInfo) === TRUE) {
              $last_id = $conn->insert_id;
              echo "<script type='text/javascript'>
                  swal.fire({
                      confirmButtonColor: '#1E40AF',
                      title: 'Success',
                      text: 'Successfully saved information',
                      icon: 'success',
                      button: 'Ok',
                  }).then(function() {
                      window.location = 'certificate.php?id=".$last_id."';
                  });
                  </script>";
          } else {
              echo "<script type='text/javascript'>
                  swal.fire({
                      confirmButtonColor: '#1E40AF',
                      title: 'Success',
                      text: 'Server error. Please contact your system administrator',
                      icon: 'success',
                      button: 'Ok',
                  });
                  </script>";
          }
        }
      }
    ?>
  </div>
</main>

<footer>
  &copy; <?= date('Y') ?> Dreams Driving Academy Inc.
</footer>

</body>
</html>