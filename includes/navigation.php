   <?php
      $al = getTableRow("Status", "other_maintenance", "WHERE OtherMaintenanceID = 1");
   ?>
   <script>
      if (<?php echo $al; ?> == 1) {
         let logoutTimer;

         const timeout = 15 * 60 * 1000;

         function resetTimer() {
            clearTimeout(logoutTimer);
            logoutTimer = setTimeout(autoLogout, timeout);
         }

         function autoLogout() {
            window.location.href = "../includes/logout.php?al=1";
         }

         window.onload = resetTimer;
         document.onmousemove = resetTimer;
         document.onkeypress = resetTimer;
         document.onclick = resetTimer;
         document.onscroll = resetTimer;
      }
   </script>
   <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
      <div class="px-3 py-3 lg:px-5 lg:pl-3">
         <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
               <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                     <span class="sr-only">Open sidebar</span>
                     <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                     </svg>
                  </button>
               <a href="#" class="flex ms-2 md:me-24">
                  <img src="../img/lmb_logo.png" class="h-8 me-3" alt="LMB Logo" />
                  <span class="self-center text-xl font-bold font-mono sm:text-2xl whitespace-nowrap">Learning Management System</span>
               </a>
            </div>
            <?php
               $fname = getTableRow("Firstname", "users", "WHERE UserID = '".$userId."'",);
               $lname = getTableRow("Lastname", "users", "WHERE UserID = '".$userId."'",);
               $fullname = $fname." ".$lname;
               $email = getTableRow("Email", "users", "WHERE UserID = '".$userId."'",);
               if ($privId == 1) {
                  $priv_desc = "Super Administrator";
               } else if ($privId == 2) {
                  $priv_desc = "Administrator Account";
               } else if ($privId == 3) {
                  $priv_desc = "Learner Account";
               }
            ?>
            <div class="flex items-center">
               <div class="flex items-center ms-3">
                  <div>
                     <button type="button" class="flex text-sm rounded-full focus:ring-2 focus:ring-gray-300" aria-expanded="false" id="dropdown-topbar" data-dropdown-toggle="dropdown-user">
                        <span class="sr-only">Open user menu</span>
                        <p class="font-bold text-md mt-2 mx-2 hidden lg:block"><?php echo $fullname;?></p>
                        <?php
                            $count_p = getTableCountWhere("user_photo", "WHERE UserID = '".$userId."'");
                            if ($count_p > 0) {
                                $p_link = getTableRow("Link", "user_photo", "WHERE UserID = '".$userId."' AND Status = 1");
                            } else {
                                $p_link = "../userphotos/no_photo.jpg";
                            }
                        ?>
                        <img class="w-8 h-8 rounded-full" src="<?php echo $p_link; ?>" alt="user photo">
                     </button>
                  </div>
                  <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-200 rounded shadow" id="dropdown-user">
                     <div class="px-4 py-3" role="none">
                     <p class="text-sm text-gray-900 font-medium" role="none"><?php echo $priv_desc;?></p>
                     <p class="text-sm text-gray-900" role="none"><?php echo $fullname;?></p>
                     <p class="text-sm font-medium text-gray-900 truncate" role="none"><?php echo $email;?></p>
                     </div>
                     <ul class="py-1" role="none">
                        <!-- <li><a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Account Settings</a></li> -->
                        <li><a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" data-modal-target="changepassword-modal" data-modal-toggle="changepassword-modal" type="button" role="menuitem">Change Password</a></li>
                        <li><a href="../includes/logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Logout</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </nav>
   <?php $page = $_GET['page']; ?>
   <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0" aria-label="Sidebar">
      <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
         <?php
            if ($privId == 3) {
         ?>
         <!-- LEARNERS MENU -->
            <ul class="space-y-2 font-medium">
               <li>
                  <a href="learners_dashboard.php?page=1<?php echo $uid_link_2;?>" class="flex items-center p-2 rounded-lg hover:bg-gray-300 <?php if($page !=1){ echo "text-gray-900"; } else { echo "text-white bg-blue-800 hover:text-gray-900"; }?>">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                           <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                     </svg>
                     <span class="ms-3">Home</span>
                  </a>
               </li>
               <li>
                  <a href="learners_courses.php?page=2<?php echo $uid_link_2;?>" class="flex items-center p-2 rounded-lg hover:bg-gray-300 <?php if($page !=2){ echo "text-gray-900"; } else { echo "text-white bg-blue-800 hover:text-gray-900"; }?>">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                     </svg>
                     <span class="flex-1 ms-3 whitespace-nowrap">Courses</span>
                     <!-- <span class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full">Pro</span> -->
                  </a>
               </li>
               <li>
                  <a href="learners_calendar.php?page=3<?php echo $uid_link_2;?>" class="flex items-center p-2 rounded-lg hover:bg-gray-300 <?php if($page !=3){ echo "text-gray-900"; } else { echo "text-white bg-blue-800 hover:text-gray-900"; }?>">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                     </svg>
                     <span class="flex-1 ms-3 whitespace-nowrap">Calendar</span>
                     <!-- <span class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full">Pro</span> -->
                  </a>
               </li>
               <li>
                  <a href="learners_inbox.php?page=4<?php echo $uid_link_2;?>" class="flex items-center p-2 rounded-lg hover:bg-gray-300 <?php if($page !=4){ echo "text-gray-900"; } else { echo "text-white bg-blue-800 hover:text-gray-900"; }?>">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                           <path stroke-linecap="round" stroke-linejoin="round" d="m7.875 14.25 1.214 1.942a2.25 2.25 0 0 0 1.908 1.058h2.006c.776 0 1.497-.4 1.908-1.058l1.214-1.942M2.41 9h4.636a2.25 2.25 0 0 1 1.872 1.002l.164.246a2.25 2.25 0 0 0 1.872 1.002h2.092a2.25 2.25 0 0 0 1.872-1.002l.164-.246A2.25 2.25 0 0 1 16.954 9h4.636M2.41 9a2.25 2.25 0 0 0-.16.832V12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 12V9.832c0-.287-.055-.57-.16-.832M2.41 9a2.25 2.25 0 0 1 .382-.632l3.285-3.832a2.25 2.25 0 0 1 1.708-.786h8.43c.657 0 1.281.287 1.709.786l3.284 3.832c.163.19.291.404.382.632M4.5 20.25h15A2.25 2.25 0 0 0 21.75 18v-2.625c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125V18a2.25 2.25 0 0 0 2.25 2.25Z" />
                     </svg>
                     <span class="flex-1 ms-3 whitespace-nowrap">Inbox</span>
                     <!-- <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full">3</span> -->
                  </a>
               </li>
               <li>
                  <a href="learners_library.php?page=14<?php echo $uid_link_2;?>" class="flex items-center p-2 rounded-lg hover:bg-gray-300 <?php if($page !=14){ echo "text-gray-900"; } else { echo "text-white bg-blue-800 hover:text-gray-900"; }?>">
                     <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                     </svg> -->
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                     </svg>


                     <span class="flex-1 ms-3 whitespace-nowrap">Library</span>
                     <!-- <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full">3</span> -->
                  </a>
               </li>
               <!-- <li>
                  <a href="learners_history.php?page=5<?php echo $uid_link_2;?>" class="flex items-center p-2 rounded-lg hover:bg-gray-300 <?php if($page !=5){ echo "text-gray-900"; } else { echo "text-white bg-blue-800 hover:text-gray-900"; }?>">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                     </svg>
                     <span class="flex-1 ms-3 whitespace-nowrap">History</span>
                  </a>
               </li> -->
            </ul>
         <!-- LEARNERS MENU -->
         <?php
            }
            else if ($privId == 1 || $privId == 2) {
         ?>
         <!-- ADMINISTRATOR MENU -->
            <ul class="space-y-2 font-medium">
               <li>
                  <a href="admin_dashboard.php?page=7<?php echo $uid_link_2;?>" class="flex items-center p-2 rounded-lg hover:bg-gray-300 <?php if($page !=7){ echo "text-gray-900"; } else { echo "text-white bg-blue-800 hover:text-gray-900"; }?>">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                           <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                     </svg>
                     <span class="ms-3">Home</span>
                  </a>
               </li>
               <li>
                  <a href="admin_courses.php?page=8<?php echo $uid_link_2;?>" class="flex items-center p-2 rounded-lg hover:bg-gray-300 <?php if($page !=8){ echo "text-gray-900"; } else { echo "text-white bg-blue-800 hover:text-gray-900"; }?>">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                     </svg>
                     <span class="flex-1 ms-3 whitespace-nowrap">Courses</span>
                     <!-- <span class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full">Pro</span> -->
                  </a>
               </li>
               <!-- <li>
                  <a href="admin_addcourses.php?page=9<?php echo $uid_link_2;?>" class="flex items-center p-2 rounded-lg hover:bg-gray-300 <?php if($page !=9){ echo "text-gray-900"; } else { echo "text-white bg-blue-800 hover:text-gray-900"; }?>">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                     </svg>
                     <span class="flex-1 ms-3 whitespace-nowrap">Add Course</span>
                  </a>
               </li> -->
               <li>
                  <a href="admin_calendar.php?page=10<?php echo $uid_link_2;?>" class="flex items-center p-2 rounded-lg hover:bg-gray-300 <?php if($page !=10){ echo "text-gray-900"; } else { echo "text-white bg-blue-800 hover:text-gray-900"; }?>">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                     </svg>
                     <span class="flex-1 ms-3 whitespace-nowrap">Calendar</span>
                     <!-- <span class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full">Pro</span> -->
                  </a>
               </li>
               <li>
                  <a href="admin_inbox.php?page=11<?php echo $uid_link_2;?>" class="flex items-center p-2 rounded-lg hover:bg-gray-300 <?php if($page !=11){ echo "text-gray-900"; } else { echo "text-white bg-blue-800 hover:text-gray-900"; }?>">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                           <path stroke-linecap="round" stroke-linejoin="round" d="m7.875 14.25 1.214 1.942a2.25 2.25 0 0 0 1.908 1.058h2.006c.776 0 1.497-.4 1.908-1.058l1.214-1.942M2.41 9h4.636a2.25 2.25 0 0 1 1.872 1.002l.164.246a2.25 2.25 0 0 0 1.872 1.002h2.092a2.25 2.25 0 0 0 1.872-1.002l.164-.246A2.25 2.25 0 0 1 16.954 9h4.636M2.41 9a2.25 2.25 0 0 0-.16.832V12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 12V9.832c0-.287-.055-.57-.16-.832M2.41 9a2.25 2.25 0 0 1 .382-.632l3.285-3.832a2.25 2.25 0 0 1 1.708-.786h8.43c.657 0 1.281.287 1.709.786l3.284 3.832c.163.19.291.404.382.632M4.5 20.25h15A2.25 2.25 0 0 0 21.75 18v-2.625c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125V18a2.25 2.25 0 0 0 2.25 2.25Z" />
                     </svg>
                     <span class="flex-1 ms-3 whitespace-nowrap">Inbox</span>
                     <!-- <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full">3</span> -->
                  </a>
               </li>
               <li>
                  <a href="admin_library.php?page=13<?php echo $uid_link_2;?>" class="flex items-center p-2 rounded-lg hover:bg-gray-300 <?php if($page !=13){ echo "text-gray-900"; } else { echo "text-white bg-blue-800 hover:text-gray-900"; }?>">
                     <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                     </svg> -->
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                     </svg>
                     <span class="flex-1 ms-3 whitespace-nowrap">Library</span>
                     <!-- <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full">3</span> -->
                  </a>
               </li>
               <!-- <li>
                  <a href="admin_history.php?page=12<?php echo $uid_link_2;?>" class="flex items-center p-2 rounded-lg hover:bg-gray-300 <?php if($page !=12){ echo "text-gray-900"; } else { echo "text-white bg-blue-800 hover:text-gray-900"; }?>">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                     </svg>
                     <span class="flex-1 ms-3 whitespace-nowrap">History</span>
                  </a>
               </li> -->
            </ul>
         <!-- ADMINISTRATOR MENU -->
         <?php
            }
            if ($privId == 1 || $privId == 2) {
         ?>
         <!-- SYSTEM MAINTENANCE -->
            <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-400">
               <button type="button" class="flex items-center w-full p-2 text-base transition duration-75 rounded-lg group hover:bg-gray-300 <?php if($page !=6){ echo "text-gray-900"; } else { echo "text-white bg-blue-800 hover:text-gray-900"; }?>" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" />
                     <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                  </svg>
                  <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Settings</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
               </button>
               <ul id="dropdown-example" class="<?php if(!isset($_GET['sm'])){ echo "hidden"; } ?> py-2 space-y-2">
                  <li>
                     <a href="user_management.php?page=6&sm=1<?php echo $uid_link_2;?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-300 <?php if(isset($_GET['sm'])){ if($_GET['sm']==1){ echo "bg-gray-300"; } } ?>">User Management</a>
                  </li>
                  <li>
                     <?php
                        if ($privId == 1) {
                     ?>
                     <a href="admin_evaluation.php?page=6&sm=2<?php echo $uid_link_2;?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-300 <?php if(isset($_GET['sm'])){ if($_GET['sm']==2){ echo "bg-gray-300"; } } ?>">Evaluation</a>
                     <?php
                        }
                        else if ($privId == 2) {
                     ?>
                     <a href="#" class="flex items-center w-full p-2 text-gray-500 transition duration-75 rounded-lg pl-11 group hover:bg-gray-300 <?php if(isset($_GET['sm'])){ if($_GET['sm']==2){ echo "bg-gray-300"; } } ?>">Evaluation</a>
                     <?php
                        }
                     ?>
                  </li>
                  <li>
                     <?php
                        if ($privId == 1) {
                     ?>
                     <a href="admin_maintenance.php?page=6&sm=3<?php echo $uid_link_2;?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-300 <?php if(isset($_GET['sm'])){ if($_GET['sm']==3){ echo "bg-gray-300"; } } ?>">Maintenance</a>
                     <?php
                        }
                        else if ($privId == 2) {
                     ?>
                     <a href="#" class="flex items-center w-full p-2 text-gray-500 transition duration-75 rounded-lg pl-11 group hover:bg-gray-300 <?php if(isset($_GET['sm'])){ if($_GET['sm']==3){ echo "bg-gray-300"; } } ?>">Maintenance</a>
                     <?php
                        }
                     ?>
                  </li>
                  <li>
                     <?php
                        if ($privId == 1) {
                     ?>
                     <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-300 <?php if(isset($_GET['sm'])){ if($_GET['sm']==4){ echo "bg-gray-300"; } } ?>">Email Gateway</a>
                     <?php
                        }
                        else if ($privId == 2) {
                     ?>
                     <a href="#" class="flex items-center w-full p-2 text-gray-500 transition duration-75 rounded-lg pl-11 group hover:bg-gray-300 <?php if(isset($_GET['sm'])){ if($_GET['sm']==4){ echo "bg-gray-300"; } } ?>">Email Gateway</a>
                     <?php
                        }
                     ?>
                  </li>
               </ul>
            </ul>
         <!-- SYSTEM MAINTENANCE -->
         <?php
            }
         ?>
      </div>
   </aside>
   <!-- CHANGE PASSWORD MODAL -->
   <div id="changepassword-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
      <div class="relative w-full h-full max-w-md md:h-auto">
         <div class="relative bg-white rounded-lg shadow">
               <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="changepassword-modal">
                  <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                  <span class="sr-only">Close modal</span>
               </button>
               <div class="px-6 py-6 lg:px-8">
                  <h3 class="mb-4 text-xl font-medium text-gray-900">Change Password</h3>
                  <hr><br>
                  <form class="space-y-6" method="POST">
                     <div>
                           <label for="change1" class="block mb-2 text-sm font-medium text-gray-900">Current Password</label>
                           <input type="password" name="change1" id="change1" autocomplete="current-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                     </div>
                     <div>
                           <label for="change2" class="block mb-2 text-sm font-medium text-gray-900">New password</label>
                           <input type="password" name="change2" id="change2" autocomplete="new-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                     </div>
                     <div>
                           <label for="change3" class="block mb-2 text-sm font-medium text-gray-900">Confirm password</label>
                           <input type="password" name="change3" id="change3" autocomplete="new-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                     </div>
                     <button type="submit" id="changepassbutton" name="changepassbutton" class="w-full text-white bg-blue-800 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Change Password</button>
                  </form>
               </div>
         </div>
      </div>
   </div>
   <!-- END OF CHANGE PASSWORD MODAL -->

   <!-- CHANGE PASSWORD PHP -->
   <?php
      if(isset($_POST['changepassbutton']))
      {
         include('../includes/dbconnect.php');
         
         $oldpass = addslashes($_POST['change1']);
         $password_1 = addslashes($_POST['change2']);
         $password_2 = addslashes($_POST['change3']);

         $currentPassword = getTableRow("PassCrypt", "users", "WHERE UniqueID='".$id."'");
         $email = getTableRow("Email", "users", "WHERE UniqueID='".$id."'");
         
         $hashed = checkhashSSHA($email, $oldpass);

         if ($hashed == $currentPassword)
         {
               if ($password_1 == $password_2)
               {
                  $hash = hashSSHA($password_1);
                  $encrypted_password = $hash["encrypted"]; // encrypted password
                  $salt = $hash["salt"]; // salt

                  $sqlChangePassword = "UPDATE users SET PassCrypt = '". $encrypted_password ."', Salt = '". $salt ."' WHERE UniqueID = '". $id ."'";
                  
                  if ($conn->query($sqlChangePassword) === TRUE) 
                  {
                     ?>
                           <script type="text/javascript">
                           swal.fire({
                              title: "Success",
                              text: "Changed password successfully.",
                              icon: "success",
                              button: "Ok",
                           }).then(function() {
                              window.location = "index.php";
                           });
                           </script>
                     <?php
                  } 
                  else
                  {
                     ?>
                     <script type="text/javascript">
                           swal.fire({
                           title: "Error",
                           text: "Server error.",
                           icon: "error",
                           button: "Ok",
                           });
                     </script>
                     <?php
                  }
               } else {
                  ?>
                     <script type="text/javascript">
                           swal.fire({
                           title: "Error",
                           text: "Incorrect password confirmation.",
                           icon: "error",
                           button: "Ok",
                           });
                     </script>
                  <?php
               }
         } else {
               ?>
                  <script type="text/javascript">
                     swal.fire({
                     title: "Error",
                     text: "Incorrect current password.",
                     icon: "error",
                     button: "Ok",
                     });
                  </script>
               <?php
         }
      }
   ?>
   <!-- END OF CHANGE PASSWORD PHP -->