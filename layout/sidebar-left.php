<?php include_once "../../config/connection.php"; ?>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          
        <ul class="sidebar-menu">
          
              <?php
		$key=0;
		$class='';
		$linkclass='';
		$result=mysqli_query($link,"SELECT m.menuid, menuname, menulink, icon
		FROM t_menus m, t_privileges p 
		WHERE  p.menuid=m.menuid 
			AND FIND_IN_SET((SELECT settingid FROM t_settings WHERE `description`='View'),p.accessid)
			AND m.status!='Inactive' AND m.position='Leftsidebar' AND parentid IS NULL 
		GROUP BY m.menuid 
		ORDER BY m.parentid ASC, m.priority asc;") or die(mysqli_error($link));
		while(list($menuid,$menuname,$menulink, $icon)=mysqli_fetch_array($result))
		{
			$query="SELECT m.menuid, menuname, menulink, icon
			FROM t_menus m, t_privileges p 
			WHERE p.usergroup='".$_SESSION['align_usergroup']."' AND p.menuid=m.menuid 
				AND FIND_IN_SET((SELECT settingid FROM t_settings WHERE `description`='View'),p.accessid)
				AND m.status!='Inactive' AND m.position='Leftsidebar' AND parentid='".$menuid."' 
			GROUP BY m.menuid 
			ORDER BY m.parentid ASC, m.priority asc";
			$submenuitem=mysqli_query($link,$query);
			if($menuid==$menu) { $class="active"; $subclass="menu-open"; } else { $class=""; $subclass=""; }
			$key++;
			if($menulink==='#') 
			{ 
				$href="#"; 
			} 
			else 
			{  
				$href="../../modules/".$menulink."node=".$menuid."&currentitem=0"."&tm=0";
			}
			if(mysqli_num_rows($submenuitem)>0) {
				$class.=" treeview";
				$arrowdown=true;
			}else{
				$arrowdown=false;
			}
			?>
				<li class="<?php echo $class; ?>">
                	<a href="<?php echo $href; ?>">
                    	<i class="<?php echo $icon; ?>"></i>
                		<span><?php echo $menuname; ?></span>
                        <?php if($arrowdown) { ?>
                        <i class="fa fa-angle-left pull-right"></i>
                        <?php } ?>
                    </a>
                	<?php
						if(mysqli_num_rows($submenuitem)>0)
						{
							echo '<ul class="treeview-menu '.$subclass.'">';	
							while(list($submenuid,$submenuname,$sublink)=mysqli_fetch_array($submenuitem))
							{ 
							
								$query1="SELECT m.menuid, menuname, menulink, icon
								FROM t_menus m, t_privileges p 
								WHERE p.usergroup='".$_SESSION['align_usergroup']."' AND p.menuid=m.menuid 
									AND FIND_IN_SET((SELECT settingid FROM t_settings WHERE `description`='View'),p.accessid)
									AND m.status!='Inactive' AND m.position='Leftsidebar' AND parentid='".$submenuid."' 
								GROUP BY m.menuid 
								ORDER BY m.parentid ASC, m.priority asc, menuname asc";
								$submenuitem1=mysqli_query($link,$query1);
								if($submenuid==$submenu) { $class="active"; $subclass="menu-open"; } else { $class=""; $subclass=""; }
								$key++;
								if($sublink==='#') 
								{ 
									$shref="#"; 
								} 
								else 
								{  
									$shref="../../modules/".$sublink."node=".$menuid."&currentitem=".$submenuid."&tm=0";
								}
								if(mysqli_num_rows($submenuitem1)>0) {
									$class.=" treeview";
									$arrowdown=true;
								}else{
									$arrowdown=false;
								}
							?>
							<li class="<?php echo $class; ?>">
                            	<a href="<?php echo $shref; ?>">
                                <i class="fa fa-angle-double-right"></i>
                                <span><?php echo $submenuname; ?></span>
                                <?php if($arrowdown) { ?>
                                <i class="fa fa-angle-left pull-right"></i>
                                <?php } ?>
                            </a>
							<?php
                                if(mysqli_num_rows($submenuitem1)>0)
                                {
									echo '<ul class="treeview-menu '.$subclass.'">';	
									while(list($submenuid1,$submenuname1,$sublink1)=mysqli_fetch_array($submenuitem1))
									{
										if($submenuid1==$submenu1) { $class="active"; } else { $class=""; }
										if($sublink1==='#') 
										{ 
											$shref1="#"; 
										} 
										else 
										{  
											$shref1="../../modules/".$sublink1."node=".$menuid."&currentitem=".$submenuid."&tm=".$submenuid1;
										}
										?>
										<li class="<?php echo $class; ?>">
											<a href="<?php echo $shref1; ?>">				
											<i class="fa fa-angle-right"></i>
											<?php echo $submenuname1; ?>
											</a>
										</li> 
					<?php			}
									echo '</ul>';
								}
								echo '</li>';
							}
							echo '</ul>';
						}
					?>
                </li>
               
		<?php }  ?>
	    </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
