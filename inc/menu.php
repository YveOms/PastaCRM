<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="dashboard.php">PastaMedia</a>
    </div>

    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i> Konfiguracja <b class="caret"></b></a>
            <ul class="dropdown-menu alert-dropdown">
            <li>
                <a href="users.php"><i class="fa fa-fw fa-users"></i> Użytkownicy</a>
            </li>
            <li>
                <a href="siteLog.php"><i class="fa fa-fw fa-clock-o"></i> Log</a>
            </li>
            </ul>
        </li>
        <li>
            <a href="login.php?logout=true"><i class="fa fa-fw fa-power-off"></i> Wyloguj</a>
        </li>
    </ul>

    <!-- Left Menu Items -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav" id="menu_left">
            <li>
                <div id="clock">
                    __________
                    <br>00-00-00
                    <br>00:00:00
                </div>
            </li>
            <li>
                <a href="dashboard.php"><i class="fa fa-fw fa-dashboard menu-icon" id="menu-icon-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="websites.php"><i class="fa fa-fw fa-globe menu-icon" id="menu-icon-websites"></i> Strony Internetowe</a>
            </li>
            <li>
                <a href="websitesCalendar.php"><i class="fa fa-fw fa-calendar menu-icon" id="menu-icon-calendar"></i> Kalendarz Płatności</a>
            </li>
            <li>
                <a href="servers.php"><i class="fa fa-fw fa-server menu-icon" id="menu-icon-servers"></i> Serwery</a>
            </li>
            <li>
                <a href="computerService.php"><i class="fa fa-fw fa-laptop menu-icon" id="menu-icon-computer-service"></i> Serwis Komputerowy</a>
            </li>
            <li>
                <a href="clients.php"><i class="fa fa-fw fa-users menu-icon" id="menu-icon-clients"></i> Klienci</a>
            </li>
            <li>
                <a href="pricingList.php"><i class="fa fa-fw fa-dollar menu-icon" id="menu-icon-pricing-list"></i> Cennik</a>
            </li>
            <li>
                <a></a>
            </li>
            <li>
                <a href="poll.php"><i class="fa fa-fw fa-pie-chart menu-icon" id="menu-icon-statistics"></i> Statystyki Ankiety</a>
            </li>
            <li>
                <a href="transactionsMore.php"><i class="fa fa-fw fa-money menu-icon" id="menu-icon-transactions"></i> Transakcje i Finanse</a>
            </li>
            <li>
                <a href="usefulTools.php"><i class="fa fa-fw fa-cogs menu-icon" id="menu-icon-useful-tools"></i> Przydatne Narzędzia</a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#templates"><i class="fa fa-fw fa-window-maximize menu-icon" id="menu-icon-templates"></i> Szablony <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="templates" class="collapse">
                    <li>
                        <a href="templatesDocuments.php"><i class="fa fa-fw fa-file-pdf-o"></i> Szablony Dokumentów</a>
                    </li>
                    <li>
                        <a href="templatesOther.php"><i class="fa fa-fw fa-code"></i> Inne</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="help.php"><i class="fa fa-fw fa-question menu-icon" id="menu-icon-help"></i> Pomoc</a>
            </li>
        </ul>
    </div>
</nav>