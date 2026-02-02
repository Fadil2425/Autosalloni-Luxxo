<?php
session_start();
require_once '../classes/Database.php';

if (!isset($_SESSION['roli']) || $_SESSION['roli'] !== 'admin') {
    header("Location: ../Dizajn/Ballina.php");
    exit();
}

$db = new Database();
$conn = $db->getConnection();

if (isset($_GET['fshij_id'])) {
    $id = (int)$_GET['fshij_id'];
    $conn->query("DELETE FROM user WHERE id = $id");
    header("Location: dashboard_user.php");
    exit();
}

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : "";

$sql = "SELECT * FROM user WHERE email NOT LIKE '%@luxxo.com'";

if ($search !== "") {
    $sql .= " AND (emri LIKE '%$search%' OR email LIKE '%$search%')";
}

$sql .= " ORDER BY id DESC";
$result = $conn->query($sql);

$total_users = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Menaxho Përdoruesit - Luxxo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <style>
        :root { --gold: #DAA520; --dark: #0a0a0a; --card: #161616; }
        body { background: var(--dark); color: white; font-family: 'Segoe UI', sans-serif; padding: 40px; margin: 0; }
        .container { max-width: 1000px; margin: auto; }
        
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 2px solid var(--gold); padding-bottom: 15px; }
        .btn-back { color: var(--gold); text-decoration: none; font-weight: bold; font-size: 14px; transition: 0.3s; }
        .btn-back:hover { color: white; }

        .search-box { margin-bottom: 20px; display: flex; gap: 10px; }
        input { flex: 1; padding: 12px; background: #111; border: 1px solid #333; color: white; border-radius: 5px; outline: none; }
        input:focus { border-color: var(--gold); }
        button { padding: 12px 25px; background: var(--gold); border: none; font-weight: bold; cursor: pointer; border-radius: 5px; color: black; }
        
        table { width: 100%; border-collapse: collapse; background: var(--card); border-radius: 8px; overflow: hidden; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #222; }
        th { background: #222; color: var(--gold); text-transform: uppercase; font-size: 13px; letter-spacing: 1px; }
        tr:hover { background: #1a1a1a; }
        
        .user-count { background: var(--gold); color: black; padding: 5px 12px; border-radius: 20px; font-weight: bold; font-size: 14px; }
        .btn-delete { color: #ff4d4d; text-decoration: none; border: 1px solid #ff4d4d; padding: 6px 12px; border-radius: 4px; transition: 0.3s; font-size: 13px; }
        .btn-delete:hover { background: #ff4d4d; color: white; }
        
        .footer-nav { margin-top: 20px; text-align: right; }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <div style="display: flex; align-items: center; gap: 15px;">
            <a href="admin_dashboard.php" class="btn-back"><i class="fas fa-chevron-left"></i> Dashboard</a>
            <h2 style="margin: 0; letter-spacing: 1px;"><i class="fas fa-users-cog"></i> MENAXHIMI I KLIENTËVE</h2>
        </div>
        <span class="user-count"><?php echo $total_users; ?> Klientë</span>
    </div>

    <form class="search-box" method="GET">
        <input type="text" name="search" placeholder="Kërko me emër ose email..." value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit"><i class="fas fa-search"></i> KËRKO</button>
        <?php if($search != ""): ?>
            <a href="dashboard_user.php" style="color: #666; align-self: center; text-decoration: none; margin-left: 10px;">Pastro</a>
        <?php endif; ?>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Emri i Klientit</th>
                <th>Email Adresa</th>
                <th>Statusi</th>
                <th>Veprime</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td>#<?php echo $row['id']; ?></td>
                    <td><strong><?php echo htmlspecialchars($row['emri']); ?></strong></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><span style="color: #28a745; font-size: 13px;"><i class="fas fa-circle" style="font-size: 8px;"></i> AKTIV</span></td>
                    <td>
                        <a href="dashboard_user.php?fshij_id=<?php echo $row['id']; ?>" 
                           class="btn-delete" 
                           onclick="return confirm('A jeni të sigurt që dëshironi ta fshini këtë klient nga sistemi?')">
                           <i class="fas fa-trash-alt"></i> Fshij
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center; padding: 60px; color: #555;">
                        <i class="fas fa-user-slash" style="font-size: 40px; margin-bottom: 15px;"></i><br>
                        Nuk u gjet asnjë klient në listë.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer-nav">
        <a href="admin_dashboard.php" style="color: #666; text-decoration: none; font-size: 13px;">
            Kthehu te Paneli Kryesor i Adminit <i class="fas fa-external-link-alt"></i>
        </a>
    </div>
</div>

</body>
</html> 