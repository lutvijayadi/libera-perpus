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
    

<section class="bg-center bg-no-repeat bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/conference.jpg')] bg-dark bg-blend-multiply">
    <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
        <h1 class="mb-6 text-4xl font-bold tracking-tighter text-white md:text-5xl lg:text-6xl">We invest in the world’s potential</h1>
        <p class="mb-8 text-base font-normal text-white md:text-xl sm:px-16 lg:px-48">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p>
        <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 md:space-x-4">
            <button type="button" class="inline-flex items-center justify-center text-white bg-brand hover:bg-brand-strong box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium rounded-base text-base px-5 py-3 focus:outline-none">
                Getting started
                <svg class="w-4 h-4 ms-1.5 -me-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"/></svg>
            </button>
            <button type="button" class="text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-base px-5 py-3 focus:outline-none">Learn more</button>
        </div>
    </div>
</section>

    <script>
        feather.replace();
    </script>
</body>

</html>