<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Perpustakaan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Apply collapsed class early -->
  <script>
    (function () {
      try {
        if (localStorage.getItem('sidebar-collapsed') === 'true') {
          document.documentElement.classList.add('sidebar-collapsed');
        }
      } catch (e) {}
    })();
  </script>

  <!-- Bootstrap CSS & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root {
      --primary: #3b82f6;
      --hover: #2563eb;
      --dark-bg: #1e293b;
      --light-bg: #f8fafc;
      --text-light: #ffffff;
      --text-dark: #1f2937;
    }

    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      overflow: hidden; /* prevent global scroll */
    }

    #wrapper {
      display: flex;
      height: 100%;
    }

    nav {
      width: 240px;
      background-color: var(--dark-bg);
      color: var(--text-light);
      flex-shrink: 0;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 24px 20px;
      transition: width 0.3s ease;
      position: relative;
    }

    .sidebar-collapsed nav {
      width: 70px;
    }

    .nav-left .nav-item {
      display: flex;
      align-items: center;
      color: var(--text-light);
      font-size: 16px;
      font-weight: 500;
      text-decoration: none;
      padding: 10px 14px;
      border-radius: 6px;
      margin-bottom: 10px;
      transition: background 0.2s ease;
      white-space: nowrap;
    }

    .nav-item:hover {
      background-color: var(--primary);
    }

    .nav-icon {
      width: 24px;
      height: 24px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      margin-right: 12px;
    }

    .sidebar-collapsed nav .nav-item span:not(.nav-icon) {
      display: none;
    }

    .sidebar-collapsed nav .nav-item {
      justify-content: center;
    }

    .user-info {
      font-size: 14px;
      border-top: 1px solid rgba(255, 255, 255, 0.2);
      padding-top: 20px;
      display: flex;
      flex-direction: column;
    }

    .logout-btn {
      margin-top: 10px;
      background: var(--primary);
      color: white;
      border: none;
      padding: 8px 12px;
      font-size: 14px;
      border-radius: 5px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .toggle-btn {
      position: absolute;
      top: 50%;
      right: -16px;
      transform: translateY(-50%);
      background: var(--primary);
      color: white;
      border-radius: 50%;
      width: 32px;
      height: 32px;
      font-size: 16px;
      border: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 1;
    }

    .toggle-btn:hover {
      background: var(--hover);
    }

    #main-content {
      flex: 1;
      height: 100vh;
      overflow-y: auto;
      padding: 40px;
      transition: padding-left 0.3s ease;
      background-color: var(--light-bg);
    }

    @media (max-width: 768px) {
      nav {
        width: 100%;
        flex-direction: row;
        padding: 16px;
        border-bottom: 4px solid var(--primary);
        position: static;
      }

      .sidebar-collapsed nav {
        width: 100%;
      }

      .nav-left {
        flex-direction: row;
        flex-wrap: wrap;
        gap: 10px;
      }

      .toggle-btn {
        display: none;
      }

      .user-info {
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        padding-top: 0;
        border-top: none;
      }

      .user-info .user-name {
        display: none;
      }

      .logout-btn {
        margin-top: 0;
        padding: 6px 10px;
        font-size: 16px;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        justify-content: center;
      }
    }
  </style>
</head>
<body>
  <div id="wrapper">
    @auth
    <nav id="sidebar">
      <div>
        <div class="nav-left">
          <a href="{{ route('dashboard') }}" class="nav-item" data-bs-toggle="tooltip" title="Dashboard">
            <span class="nav-icon"><i class="bi bi-speedometer2"></i></span>
            <span>Dashboard</span>
          </a>
          <a href="{{ route('books.index') }}" class="nav-item" data-bs-toggle="tooltip" title="Buku">
            <span class="nav-icon"><i class="bi bi-book"></i></span>
            <span>Buku</span>
          </a>
          <a href="{{ route('borrows.index') }}" class="nav-item" data-bs-toggle="tooltip" title="Peminjaman">
            <span class="nav-icon"><i class="bi bi-journal-arrow-up"></i></span>
            <span>Peminjaman</span>
          </a>
          <a href="{{ route('report.index') }}" class="nav-item" data-bs-toggle="tooltip" title="Laporan">
            <span class="nav-icon"><i class="bi bi-bar-chart"></i></span>
            <span>Laporan</span>
          </a>
        </div>
      </div>

      <div class="user-info mt-3">
        <div class="user-name">{{ Auth::user()->name }}</div>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="logout-btn" data-bs-toggle="tooltip" title="Logout">
            <i class="bi bi-box-arrow-right"></i>
          </button>
        </form>
      </div>

      <button class="toggle-btn" id="sidebarToggleBtn" onclick="toggleSidebar()">❮</button>
    </nav>
    @endauth

    <main id="main-content">
      @yield('content')
    </main>
  </div>

  <!-- Bootstrap JS Bundle + Enable Tooltips -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const toggleBtn = document.getElementById('sidebarToggleBtn');

    function setSidebarState(collapsed) {
      if (collapsed) {
        document.documentElement.classList.add('sidebar-collapsed');
        toggleBtn.textContent = '❯';
      } else {
        document.documentElement.classList.remove('sidebar-collapsed');
        toggleBtn.textContent = '❮';
      }
      localStorage.setItem('sidebar-collapsed', collapsed ? 'true' : 'false');
    }

    function toggleSidebar() {
      const isCollapsed = document.documentElement.classList.contains('sidebar-collapsed');
      setSidebarState(!isCollapsed);
    }

    document.addEventListener('DOMContentLoaded', () => {
      const collapsed = localStorage.getItem('sidebar-collapsed') === 'true';
      setSidebarState(collapsed);

      const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      tooltipTriggerList.map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    });
  </script>
</body>
</html>
