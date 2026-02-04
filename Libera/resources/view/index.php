<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <title>Document</title>
</head>

<body class="bg-black">
    <div class="container mx-auto">
        <nav class="flex justify-between items-center">
            <div>
                <img src="../img/logo.png" alt="Logo">
            </div>
            <ul class="text-white font-bold text-xs lg:flex gap-8 hidden">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="manage_users.php">Manage Users</a></li>
                <li><a href="settings.php">Settings</a></li>
                <li><a href="../aksi/aksi_logout.php">Logout</a></li>
            </ul>
            <div class="lg:flex gap-4 hidden">
                <button class="text-white outline px-9 py-4 rounded-full font-bold text-xs">Logout</button>
                <button
                    class="text-black bg-blue-500 font-bold outline rounded-full px-9 py-4 text-xs h-14 bg-linear-to-r from-cyan-500 to-blue-500">masuk</button>
                <div class="lg:flex hidden gap-4">
                    <button>
                        <i data-feather="menu" class="lg:hidden text-white"></i>
                    </button>
                </div>
        </nav>
        <div class="mobileMenu">
            <ul class="text-white font-bold text-xs">
                <li class="py-4 px-3 cursor-pointer cover-blue bg-black"><a href="dashboard.php">Dashboard</a></li>
                <li class="py-4 px-3 cursor-pointer cover-blue bg-black"><a href="manage_users.php">Manage Users</a>
                </li>
                <li class="py-4 px-3 cursor-pointer cover-blue bg-black"><a href="settings.php">Settings</a></li>
                <li class="py-4 px-3 cursor-pointer cover-blue bg-black"><a href="../aksi/aksi_logout.php">Logout</a>
                </li>
            </ul>
        </div>
        <div class="flex gap-4 mt-4">
            <button class="w-full text-white outline px-9 py-4 rounded-full font-bold text-xs">Logout</button>
            <button
                class="w-full text-black bg-blue-500 font-bold outline rounded-full px-9 py-4 text-xs h-14 bg-linear-to-r from-cyan-500 to-blue-500">masuk</button>
        </div>
    </div>
    <script>
        feather.replace();
    </script>
</body>

</html>