<?php
    include("../includes/functions.php");
    include("../includes/dbconnect.php");

    $search = isset($_GET['search']) ? trim($_GET['search']) : '';

    if ($search !== '') {
        $stmt = $conn->prepare(
            "SELECT * FROM info_list
             WHERE Name LIKE CONCAT('%', ?, '%')
                OR CertificateNumber LIKE CONCAT('%', ?, '%')
                OR Course LIKE CONCAT('%', ?, '%')
                OR AccreditationNumber LIKE CONCAT('%', ?, '%')
             ORDER BY DateIssued DESC"
        );
        $stmt->bind_param('ssss', $search, $search, $search, $search);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $result = $conn->query("SELECT * FROM info_list ORDER BY DateIssued DESC");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Certificate List | Dreams Driving Academy Inc.</title>
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
  img { width: 150px; }
  header {
    background: #FEDA08;
    color: #fff;
    padding: 28px 20px;
    text-align: center;
  }
  header h1 { margin: 0; font-size: 22px; letter-spacing: 0.3px; color: #000000; }
  main {
    max-width: 960px;
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
  .card-head {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 16px;
    flex-wrap: wrap;
  }
  .card-head h2 { margin: 0 0 4px; font-size: 17px; color: var(--navy); }
  .card-head p { margin: 0; font-size: 14px; color: #5a6478; }

  .search-form {
    display: flex;
    gap: 10px;
    margin: 20px 0 4px;
  }
  .search-form input[type=text] {
    flex: 1;
    padding: 11px 14px;
    border: 1px solid #c9d2e0;
    border-radius: 8px;
    font-size: 14px;
    font-family: inherit;
  }
  .search-form input[type=text]:focus {
    outline: none;
    border-color: var(--blue);
    box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.15);
  }

  a.btn, button.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 44px;
    padding: 0 18px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    white-space: nowrap;
    border: 1.5px solid var(--blue);
  }
  a.btn-outline {
    background: transparent;
    color: var(--blue);
  }
  a.btn-outline:hover { background: var(--blue); color: #fff; }
  button.btn-filled, a.btn-filled {
    background: var(--blue);
    color: #fff;
  }
  button.btn-filled:hover, a.btn-filled:hover { background: #1743ab; }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 18px;
    font-size: 14px;
  }
  thead th {
    text-align: left;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.03em;
    color: #6b7688;
    padding: 10px 12px;
    border-bottom: 2px solid var(--border);
    white-space: nowrap;
  }
  tbody td {
    padding: 12px;
    border-bottom: 1px solid var(--border);
    vertical-align: middle;
  }
  tbody tr:hover { background: #f8fafc; }

  .status {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
  }
  .status.valid   { background: #eafaf0; color: var(--green); }
  .status.expired { background: #fdecec; color: var(--red); }

  .row-actions a {
    font-size: 13px;
    font-weight: 600;
    color: var(--blue);
    text-decoration: none;
  }
  .row-actions a:hover { text-decoration: underline; }

  .empty-state {
    text-align: center;
    padding: 40px 20px;
    color: #6b7688;
    font-size: 14px;
  }

  .table-wrap { overflow-x: auto; }

  footer {
    text-align: center;
    font-size: 12px;
    color: #8a93a6;
    padding-bottom: 30px;
  }

  @media (max-width: 600px) {
    .card-head { flex-direction: column; }
    .search-form { flex-direction: column; }
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
    <div class="card-head">
      <div>
        <h2>Certificate List</h2>
        <p>All certificates issued by Dreams Driving Academy Inc.</p>
      </div>
      <a href="certificate.php" class="btn btn-filled">+ New Certificate</a>
    </div>

    <form method="GET" action="" class="search-form">
      <input type="text" name="search" placeholder="Search by name, certificate no., course, or accreditation no."
             value="<?= htmlspecialchars($search, ENT_QUOTES, 'UTF-8') ?>">
      <button type="submit" class="btn btn-filled">Search</button>
      <?php if ($search !== ''): ?>
        <a href="list.php" class="btn btn-outline">Clear</a>
      <?php endif; ?>
    </form>

    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Course</th>
            <th>Certificate No.</th>
            <th>Accreditation No.</th>
            <th>Date Issued</th>
            <th>Valid Until</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
              <?php
                $isExpired = !empty($row['ValidUntil']) && strtotime($row['ValidUntil']) < time();
              ?>
              <tr>
                <td><?= htmlspecialchars($row['Name'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($row['Course'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($row['CertificateNumber'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($row['AccreditationNumber'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars(date('M j, Y', strtotime($row['DateIssued'])), ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars(date('M j, Y', strtotime($row['ValidUntil'])), ENT_QUOTES, 'UTF-8') ?></td>
                <td class="row-actions">
                  <a href="index.php?id=<?= (int)$row['ID'] ?>">View Auth.</a>
                </td>
                <td class="row-actions">
                  <a href="certificate.php?id=<?= (int)$row['ID'] ?>">Edit</a>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="8" class="empty-state">
                <?= $search !== '' ? 'No certificates match your search.' : 'No certificates recorded yet.' ?>
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<footer>
  &copy; <?= date('Y') ?> Dreams Driving Academy Inc.
</footer>

</body>
</html>