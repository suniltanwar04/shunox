<?php
$uri = $this->uri->segment(1) . '/' . $this->uri->segment(2);

$settings = [CommonConstants::ADMIN_URL_SLUG . '/categories', CommonConstants::ADMIN_URL_SLUG . '/sub-categories', CommonConstants::ADMIN_URL_SLUG . '/attributes', CommonConstants::ADMIN_URL_SLUG . '/attribute-values'];
if (in_array($uri, $settings)) {
    $settingsActiveClass = 'active';
} else {
    $settingsActiveClass = '';
}






?>


<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <?php
            if ($this->session->userdata('UserRole') == 1) {
                ?>
                <li class="treeview"><a
                        href="<?php echo $this->config->item('admin_base_url') . 'dashboard'; ?>"
                        rel="tab"><i
                            class="fa fa-dashboard"></i>
                        <span>Dashboard</span></a>
                </li>

                <!--<li class="treeview <?php /*echo $settingsActiveClass; */?>">
                    <a href="#" rel="tab"><i
                            class="fa fa-gears"></i>
                        <span>Settings</span><i
                            class="fa fa-angle-left pull-right">
                        </i>
                    </a>
                    <ul class="treeview-menu">-->
                        <li>
                            <a href="<?php echo $this->config->item('admin_base_url') . 'categories'; ?>" rel="tab">
                                <i class="fa fa-circle-o"></i>
                                <span>Category</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo $this->config->item('admin_base_url') . 'sub-categories'; ?>" rel="tab">
                                <i class="fa fa-circle-o"></i>
                                <span>Sub Category</span>
                            </a>
                        </li>


                        <li>
                            <a href="<?php echo $this->config->item('admin_base_url') . 'attributes'; ?>" rel="tab">
                                <i class="fa fa-circle-o"></i>
                                <span>Attribute</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo $this->config->item('admin_base_url') . 'attribute-values'; ?>"
                               rel="tab">
                                <i class="fa fa-circle-o"></i>
                                <span>Attribute Value</span>
                            </a>
                        </li>

                    <!--</ul>
                </li>-->






                <li class="treeview">
                    <a href="<?php echo $this->config->item('admin_base_url') . 'product'; ?>" rel="tab">
                        <i class="fa fa-circle-o"></i>
                        <span>Product</span>
                    </a>
                </li>

                <li class="treeview">
                    <a href="<?php echo $this->config->item('admin_base_url') . 'user-management'; ?>" rel="tab">
                        <i class="fa fa-circle-o"></i>
                        <span>User Management</span>
                    </a>
                </li>

				<li class="treeview">
                    <a href="<?php echo $this->config->item('admin_base_url') . 'coupon'; ?>" rel="tab">
                        <i class="fa fa-circle-o"></i>
                        <span>Coupon Management</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="<?php echo $this->config->item('admin_base_url') . 'order-management'; ?>" rel="tab">
                        <i class="fa fa-circle-o"></i>
                        <span>Order Management</span>
                    </a>
                </li>

              <li class="treeview">
                    <a href="<?php echo $this->config->item('admin_base_url') . 'settings'; ?>" rel="tab">
                        <i class="fa fa-circle-o"></i>
                        <span>Setting</span>
                    </a>
                </li>

                <li class="treeview">
                    <a href="<?php echo $this->config->item('admin_base_url') . 'banner'; ?>" rel="tab">
                        <i class="fa fa-circle-o"></i>
                        <span>Banner</span>
                    </a>
                </li>

                <li class="treeview">
                    <a href="<?php echo $this->config->item('admin_base_url') . 'social'; ?>" rel="tab">
                        <i class="fa fa-circle-o"></i>
                        <span>Social</span>
                    </a>
                </li>

                <li class="treeview">
                    <a href="<?php echo $this->config->item('admin_base_url') . 'newsletter'; ?>" rel="tab">
                        <i class="fa fa-circle-o"></i>
                        <span>NewsLetter</span>
                    </a>
                </li>

                <li class="treeview">
                    <a href="<?php echo $this->config->item('admin_base_url') . 'pagelist'; ?>" rel="tab">
                        <i class="fa fa-circle-o"></i>
                        <span>Pages</span>
                    </a>
                </li>

                <li class="treeview">
                    <a href="<?php echo $this->config->item('admin_base_url') . 'location'; ?>" rel="tab">
                        <i class="fa fa-circle-o"></i>
                        <span>Scanning Location</span>
                    </a>
                </li>
                
                <li class="treeview">
                    <a href="<?php echo $this->config->item('admin_base_url') . 'blogs'; ?>" rel="tab">
                        <i class="fa fa-circle-o"></i>
                        <span>Blogs</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="<?php echo $this->config->item('admin_base_url') . 'become-dealer'; ?>" rel="tab">
                        <i class="fa fa-circle-o"></i>
                        <span>Become Dealer</span>
                    </a>
                </li>
                
                <li class="treeview">
                    <a href="<?php echo $this->config->item('admin_base_url') . 'become-dealer-with-id'; ?>" rel="tab">
                        <i class="fa fa-circle-o"></i>
                        <span>Dealer</span>
                    </a>
                </li>



            <?php
            }
            ?>


        </ul>
    </section>
</aside>

<script type="text/javascript">
    $(document).ready(function () {
        current_page_link = document.location.href;
        $(".sidebar-menu a").each(function () {
            var link_loop = $.trim($(this).attr("href"));
            if (link_loop === current_page_link) {
                var found_url = $(this).attr("href");
                $('.sidebar-menu a[href="' + found_url + '"]').parent().addClass('active');
            }
        });
    });
</script>
