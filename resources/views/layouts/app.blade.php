<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSKOR Motors Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root{
            --body-bg:#f4f6f9;
            --card-bg:#ffffff;
            --text:#0f172a;
            --muted:#64748b;
            --border:#e5e7eb;
            --sidebar:#0f172a;
            --sidebar-link:#cbd5e1;
            --sidebar-hover:#1e293b;
            --topbar:#ffffff;
        }

        body.dark{
            --body-bg:#0b1120;
            --card-bg:#111827;
            --text:#f8fafc;
            --muted:#94a3b8;
            --border:#263244;
            --sidebar:#020617;
            --sidebar-link:#cbd5e1;
            --sidebar-hover:#1e293b;
            --topbar:#111827;
        }

        body{
            background:var(--body-bg);
            color:var(--text);
            font-family:Arial, sans-serif;
        }

        .sidebar{
            width:270px;
            min-height:100vh;
            background:var(--sidebar);
            transition:.3s;
            position:fixed;
            left:0;
            top:0;
            z-index:1000;
        }

        .sidebar.closed{
            margin-left:-270px;
        }

        .main-content{
            margin-left:270px;
            min-height:100vh;
            transition:.3s;
        }

        .main-content.full{
            margin-left:0;
        }

        .logo-box{
            border-bottom:1px solid #334155;
        }

        .logo-img{
            width:46px;
            height:46px;
            object-fit:cover;
            border-radius:10px;
            background:white;
            padding:4px;
        }

        .sidebar a{
            color:var(--sidebar-link);
            text-decoration:none;
            display:flex;
            align-items:center;
            gap:12px;
            padding:12px 14px;
            border-radius:8px;
            margin-bottom:6px;
            font-size:15px;
        }

        .sidebar a:hover,
        .sidebar a.active{
            background:var(--sidebar-hover);
            color:white;
        }

        .topbar{
            height:66px;
            background:var(--topbar);
            border-bottom:1px solid var(--border);
            position:sticky;
            top:0;
            z-index:900;
        }

        .menu-btn{
            border:none!important;
            outline:none!important;
            background:transparent!important;
            box-shadow:none!important;
            font-size:32px;
            color:var(--text);
            cursor:pointer;
            padding:0;
            line-height:1;
        }

        .theme-btn{
            border:1px solid var(--border);
            background:var(--card-bg);
            color:var(--text);
            width:38px;
            height:38px;
            border-radius:50%;
        }

        .card,
        .table,
        .form-control,
        .form-select{
            background:var(--card-bg)!important;
            color:var(--text)!important;
            border-color:var(--border)!important;
        }

        .text-muted{
            color:var(--muted)!important;
        }

        .card{
            border:none;
            border-radius:14px;
            transition:all .25s ease;
        }

        .card:hover{
            transform:translateY(-3px);
            box-shadow:0 .5rem 1rem rgba(0,0,0,.12)!important;
        }

        .table thead th{
            background:#0f172a!important;
            color:white!important;
        }

        .form-control::placeholder{
            color:var(--muted);
        }

        .mobile-overlay{
            display:none;
        }

        footer{
            color:var(--muted);
        }

        body.dark .table{
            color:var(--text)!important;
        }

        body.dark .table td,
        body.dark .table th{
            border-color:#263244!important;
        }

        body.dark .table thead th{
            background:#111827!important;
            color:#e5e7eb!important;
        }

        body.dark .table tbody tr{
            background:#111827!important;
        }

        body.dark .table-hover tbody tr:hover{
            background:#1b2435!important;
        }

        body.dark .form-control,
        body.dark .form-select{
            background:#111827!important;
            color:#e5e7eb!important;
            border-color:#263244!important;
        }

        body.dark .form-control:focus,
        body.dark .form-select:focus{
            background:#111827!important;
            color:#e5e7eb!important;
        }

        body.dark table,
        body.dark .table,
        body.dark .table tbody,
        body.dark .table tbody tr,
        body.dark .table tbody td{
            background:#111827!important;
            color:#e5e7eb!important;
        }

        body.dark .table tbody tr:nth-child(even) td{
            background:#0f172a!important;
        }

        body.dark .table tbody tr:hover td{
            background:#1e293b!important;
        }

        body.dark .table td,
        body.dark .table th{
            border-color:#334155!important;
        }

        body.dark .table small,
        body.dark .table .text-muted{
            color:#94a3b8!important;
        }

        body.dark .btn-outline-dark{
            color:#e5e7eb!important;
            border-color:#64748b!important;
            background:#1e293b!important;
        }

        body.dark .btn-outline-dark:hover{
            color:white!important;
            background:#334155!important;
            border-color:#94a3b8!important;
        }

        @media(max-width:768px){
            .sidebar{
                margin-left:-270px;
            }

            .sidebar.mobile-open{
                margin-left:0;
            }

            .main-content{
                margin-left:0;
            }

            .mobile-overlay.show{
                display:block;
                position:fixed;
                inset:0;
                background:rgba(0,0,0,.45);
                z-index:999;
            }

            .topbar-title small{
                display:none;
            }
        }
    </style>
</head>

<body>

<div id="mobileOverlay" class="mobile-overlay"></div>

<aside id="sidebar" class="sidebar p-3">
    <div class="logo-box pb-3 mb-3 d-flex align-items-center gap-3">
        <img src="{{ asset('images/pskor_logo.png') }}" class="logo-img" alt="Logo">
        <div>
            <h5 class="text-white mb-0">PSKOR Motors</h5>
            <small class="text-secondary">Dealership System</small>
        </div>
    </div>

    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="bi bi-grid"></i> Dashboard
    </a>

    <a href="{{ route('cars.index') }}" class="{{ request()->routeIs('cars.*') ? 'active' : '' }}">
        <i class="bi bi-car-front"></i> Cars
    </a>

    <a href="{{ route('customers.index') }}" class="{{ request()->routeIs('customers.*') ? 'active' : '' }}">
        <i class="bi bi-people"></i> Customers
    </a>

    <a href="{{ route('staff.index') }}" class="{{ request()->routeIs('staff.*') ? 'active' : '' }}">
        <i class="bi bi-person-workspace"></i> Staff
    </a>

    <a href="{{ route('sales.index') }}" class="{{ request()->routeIs('sales.*') ? 'active' : '' }}">
        <i class="bi bi-receipt"></i> Sales
    </a>
</aside>

<main id="mainContent" class="main-content">
    <div class="topbar d-flex align-items-center justify-content-between px-4">
        <div class="d-flex align-items-center gap-3">
            <button id="toggleSidebar" class="menu-btn">&#9776;</button>

            <div class="topbar-title">
                <h5 class="mb-0 fw-bold">PSKOR Motors Management System</h5>
                <small class="text-muted">Dealership Inventory & Sales Platform</small>
            </div>
        </div>

        <div class="d-flex align-items-center gap-3">
            <button id="themeToggle" class="theme-btn">
                <i id="themeIcon" class="bi bi-moon"></i>
            </button>

            <div class="text-end d-none d-md-block">
                <strong>Admin</strong><br>
                <small class="text-muted">System User</small>
            </div>
        </div>
    </div>

    <div class="container-fluid p-4">
        @yield('content')

        <footer class="text-center mt-5 small">
            PSKOR Motors Management System v1.0<br>
            © 2026 PSKOR Motors. All Rights Reserved.
        </footer>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
    icon:'success',
    title:'Success',
    text:'{{ session('success') }}',
    timer:2000,
    showConfirmButton:false
});
</script>
@endif

<script>
let searchTimer;

function autoSearch(input)
{
    clearTimeout(searchTimer);

    searchTimer = setTimeout(function(){
        input.form.submit();
    },500);
}

const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('mainContent');
const mobileOverlay = document.getElementById('mobileOverlay');

document.getElementById('toggleSidebar').addEventListener('click',function(){
    if(window.innerWidth <= 768){
        sidebar.classList.toggle('mobile-open');
        mobileOverlay.classList.toggle('show');
    }else{
        sidebar.classList.toggle('closed');
        mainContent.classList.toggle('full');
    }
});

mobileOverlay.addEventListener('click',function(){
    sidebar.classList.remove('mobile-open');
    mobileOverlay.classList.remove('show');
});

function confirmDelete(form)
{
    Swal.fire({
        title:'Delete Record?',
        text:'This action cannot be undone.',
        icon:'warning',
        showCancelButton:true,
        confirmButtonColor:'#dc3545',
        cancelButtonColor:'#6c757d',
        confirmButtonText:'Yes, Delete',
        cancelButtonText:'Cancel'
    }).then((result)=>{
        if(result.isConfirmed){
            form.submit();
        }
    });

    return false;
}

const themeToggle = document.getElementById('themeToggle');
const themeIcon = document.getElementById('themeIcon');

if(localStorage.getItem('theme') === 'dark'){
    document.body.classList.add('dark');
    themeIcon.className = 'bi bi-sun';
}

themeToggle.addEventListener('click',function(){
    document.body.classList.toggle('dark');

    if(document.body.classList.contains('dark')){
        localStorage.setItem('theme','dark');
        themeIcon.className = 'bi bi-sun';
    }else{
        localStorage.setItem('theme','light');
        themeIcon.className = 'bi bi-moon';
    }
});
</script>

</body>
</html>