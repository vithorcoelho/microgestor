<nav class="navbar ks-navbar">
       <div class="ks-wrapper" style="max-width: 1110px; margin: 0 auto; padding: 0 0 0 0">
            <?php $this->load->view('logo'); ?>
            <nav class="nav navbar-nav">
                
                <?php $this->load->view('nav'); ?>
                
                <div class="ks-navbar-actions">
                    <?php //$this->load->view('languages'); ?>
                    <?php //$this->load->view('messages'); ?>
                    <?php //$this->load->view('notifications'); ?>
                    <?php //$this->load->view('user'); ?>
                </div>
            </nav>

            <nav class="nav navbar-nav ks-navbar-menu-toggle">
                <a class="nav-item nav-link" href="#">
                    <span class="la la-th ks-icon ks-open"></span>
                    <span class="la la-close ks-icon ks-close"></span>
                </a>
            </nav>
        </div>     
    
</nav>