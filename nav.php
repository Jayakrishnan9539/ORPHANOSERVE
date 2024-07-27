<nav class="navbar col-lg-12 col-12 px-0 py-0 d-flex flex-row" style="height: 150px;">
    <div class="navbar-menu-wrapper bg-dark navbar-search-wrapper dd-none dd-lg-flex d-flex align-items-center rounded-c">
        <ul class="navbar-nav">
            <li class="nav-item nav-search dd-none dd-lg-block">
                <h4 class="font-weight-bold mb-0 dd-none dd-md-block mt-1 text-white">Welcome back, <?php echo $_SESSION['SESS_USER_NAME'] ?></h4>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                    <img src="images/faces/avatar.png" alt="profile" class="rounded-c" />
                    <span class="nav-profile-name text-white"><?php echo ucwords($_SESSION['SESS_USER_NAME']) ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <!--<a class="dropdown-item" href="password.php">
                        <i class="mdi mdi-settings text-primary"></i> Update Password
                    </a>-->
                    <?php if ($_SESSION['SESS_USER_TYPE'] == 'admin') { ?>
                        <a class="dropdown-item" href="reset.php">
                            <i class="mdi mdi-logout text-primary"></i> RESET
                        </a>
                        <a class="dropdown-item" href="orphanage.php">
                            <i class="mdi mdi-logout text-primary"></i> ORPHANAGE
                        </a>
                        <a class="dropdown-item" href="doctors.php">
                            <i class="mdi mdi-logout text-primary"></i> DOCTORS
                        </a>
                        <a class="dropdown-item" href="donors.php">
                            <i class="mdi mdi-logout text-primary"></i> DONORS
                        </a>
                    <?php } ?>
                    
                        
                        
                    
                    <a class="dropdown-item" href="logout.php">
                        <i class="mdi mdi-logout text-primary"></i> LOGOUT
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>