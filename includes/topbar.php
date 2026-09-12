<!-- HEADER -->
<header class="sticky top-0 w-full h-24 bg-gray-800 drop-shadow-lg z-50">
<!-- <header class="absolute top-0 w-full h-24 bg-gray-800 drop-shadow-lg"> -->
    <div class="container px-4 md:px-0 h-full mx-auto flex justify-between items-center">
        <!-- Logo Here -->
        <?php
            $logo = "";
            if ($privId == 1 || $privId == 2) {
                $logo = "dashboard.php".$uid_link;
            } else if ($privId == 3) {
                $logo = "personalinfo.php".$uid_link;
            }
        ?>
        <a class="text-xl font-bold italic" href="#"><img src="../img/LMB_header.png" class="h-16"></a>
        <!-- Menu links here -->
        <ul id="menu" class="hidden fixed top-0 right-0 px-10 py-16 bg-gray-800 z-50 md:relative md:flex md:p-0 md:bg-transparent md:flex-row md:space-x-6">
            <?php $page = $_GET["page"]; ?>
            <li class="md:hidden z-90 fixed top-4 right-6"><a href="javascript:void(0)" class="text-right text-white text-4xl" onclick="toggleMenu()">&times;</a></li>
            <?php
                if ($privId == 3) {
            ?>
                <li><a class="text-white <?php if($page!=1){echo"opacity-60 hover:opacity-100 duration-300";}?>" href="personalinfo.php?page=1<?php echo $uid_link_2?>">Personal Information</a></li>
                <li><a class="text-white <?php if($page!=2){echo"opacity-60 hover:opacity-100 duration-300";}?>" href="setappointment.php?page=2<?php echo $uid_link_2?>">Request Appointment</a></li>
                <li><a class="text-white <?php if($page!=3){echo"opacity-60 hover:opacity-100 duration-300";}?>" href="appointments.php?page=3<?php echo $uid_link_2?>">Appointments</a></li>
                <!-- <li><a class="text-white <?php //if($page!=4){echo"opacity-60 hover:opacity-100 duration-300";}?>" href="contactus.php?page=4<?php //echo $uid_link_2?>">Contact Us</a></li> -->
            <?php   
                } else if ($privId == 1 || $privId == 2) {
            ?>
                <li><a class="text-white <?php if($page!=5){echo"opacity-60 hover:opacity-100 duration-300";}?>" href="dashboard.php?page=5<?php echo $uid_link_2?>">Dashboard</a></li>
                <li><a class="text-white <?php if($page!=9){echo"opacity-60 hover:opacity-100 duration-300";}?>" href="id-verification-list.php?page=9<?php echo $uid_link_2?>">ID Validation Requests</a></li>
                <!-- APPOINTMENTS -->
                <li>
                    <button id="dropdownAppointmentsLink" data-dropdown-toggle="dropdownAppointments" class="flex items-center justify-between w-full py-2 pl-3 pr-4 text-white <?php if($page!=6){echo"opacity-60 hover:opacity-100 duration-300";}?> md:hover:bg-transparent md:border-0 md:hover:text-white md:p-0 md:w-auto">Appointments<svg class="w-5 h-5 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
                    <div id="dropdownAppointments" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="clientappointments.php?page=6<?php echo $uid_link_2?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-400 dark:hover:text-white">Appointment Requests</a>
                            </li>
                            <li>
                                <a href="clientappointments.php?page=6<?php echo $uid_link_2?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-400 dark:hover:text-white">Scheduled Appointments</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- APPOINTMENTS -->
                <li><a class="text-white <?php if($page!=7){echo"opacity-60 hover:opacity-100 duration-300";}?>" href="reports.php?page=7<?php echo $uid_link_2?>">Reports</a></li>
                <!-- SYSTEM MAINTENANCE -->
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 pl-3 pr-4 text-white <?php if($page!=8){echo"opacity-60 hover:opacity-100 duration-300";}?> md:hover:bg-transparent md:border-0 md:hover:text-white md:p-0 md:w-auto">System Maintenance<svg class="w-5 h-5 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
                    <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                    <div class="py-1">
                        <a href="add_holiday.php?page=8<?php echo $uid_link_2?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-400 dark:text-gray-400 dark:hover:text-white">Add/Delete Holidays</a>
                    </div>
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="user_management.php?page=8<?php echo $uid_link_2?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-400 dark:hover:text-white">User Management</a>
                            </li>
                            <li>
                                <a href="maintenance.php?page=8<?php echo $uid_link_2?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-400 dark:hover:text-white">Other Maintenance</a>
                            </li>
                            <li>
                                <a href="auto.php<?php echo $uid_link?>" target="popup" onclick="window.open('auto.php<?php echo $uid_link?>','name','width=1200,height=400')" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-400 dark:hover:text-white">Email Gateway</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- SYSTEM MAINTENANCE -->
            <?php
                }
            ?>
            <li class="md:pl-0 md:pr-0">
                <div class="flex flex-row">
                    <!-- <div class="pl-8 pr-3">
                        <img class='w-8 rounded-2xl' src='../img/default.jpg'>
                    </div> -->
                    <div class="pl-8 pr-3">
                        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-gray-400 font-semibold hover:text-white transition duration-200 bg-gray-800 text-center inline-flex items-center" type="button"> <?php echo $firstname. " " .$lastname?><svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
                        <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                                <li>
                                    <a href="#" data-modal-target="changepassword-modal" data-modal-toggle="changepassword-modal" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" type="button">Change Password</a>
                                </li>
                                <li>
                                    <a href="../includes/logout.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign out</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <!-- This is used to open the menu on mobile devices -->
        <div class="flex items-center md:hidden">
            <button class="text-white text-4xl font-bold opacity-70 hover:opacity-100 duration-300" onclick="toggleMenu()"> &#9776; </button>
        </div>
    </div>
</header>
<!-- END OF HEADER -->
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
                        <input type="password" name="change1" id="change1" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="change2" class="block mb-2 text-sm font-medium text-gray-900">New password</label>
                        <input type="password" name="change2" id="change2" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="change3" class="block mb-2 text-sm font-medium text-gray-900">Confirm password</label>
                        <input type="password" name="change3" id="change3" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>
                    <button type="submit" id="changepassbutton" name="changepassbutton" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Change Password</button>
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