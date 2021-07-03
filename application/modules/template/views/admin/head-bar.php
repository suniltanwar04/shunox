</head>
<body class="hold-transition skin-blue sidebar-mini">
<input type="hidden" id="baseUrl" name="baseUrl" value="<?php echo base_url(); ?>">
<input type="hidden" id="loggedIdUser" name="loggedIdUser" value="<?php echo $this->session->userdata('adminId'); ?>">

<input type="hidden" id="selectedUserId" name="selectedUserId"
       value="<?php echo isset($selectedUserId) ? $selectedUserId : 0; ?>">

<div class="wrapper">
    <div id="loading"></div>


    <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
            <span class="logo-lg">
<!--                <img src="--><?php //echo base_url(); ?><!--assets/admin/img/logo.png" class="logo-image"/>-->
                Globusnexgen
            </span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true" aria-expanded="false">


						<span class="username username-hide-on-mobile hidden-xs">
						<?php
                        $email =  callModelFunction('AdminLogin_model', 'getEmail');
                        if ($email) {
                            echo $email->Email;
                        } ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a style="cursor: pointer; color: #000" class="viewProfile"
                                   id="<?php echo 1; ?>" data-target="#changeEmail" data-toggle="modal" >
                                    <i class="fa fa-user"></i> Change Email </a>
                            </li>

                            <li>
                                <a id="logout" style="cursor: pointer; color: #000"
                                   href="<?php echo $this->config->item('admin_base_url') . 'logout'; ?>">
                                    <i class="fa fa-sign-out"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>


                </ul>
            </div>

        </nav>
    </header>
    <?php $this->load->view('template/admin/modal/emailupdate');?>