            <div class="sidebar" style="position: fixed;">
                <div class="brand">
                    <img src="../../../../public/assets/images/logo.svg" alt="logo" srcset="">
                    <div class="user"><?php echo $firstName ?></div>
                </div>
                <div class="division"></div>
                <div class="links">
                    <div class="menus">
                        <a href="" class="menu">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="str" d="M9.16667 2.75H2.75V9.16667H9.16667V2.75Z" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="str" d="M19.25 2.75H12.8333V9.16667H19.25V2.75Z" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="str" d="M19.25 12.8334H12.8333V19.25H19.25V12.8334Z" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="str" d="M9.16667 12.8334H2.75V19.25H9.16667V12.8334Z" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div class="text">Dashboard</div>
                        </a>
                        <a href="../../pages/office_staff/houses.php" class="menu active">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="str active" d="M8.25 20.1667H4.58333C4.0971 20.1667 3.63079 19.9736 3.28697 19.6297C2.94315 19.2859 2.75 18.8196 2.75 18.3334V8.25004L11 1.83337L19.25 8.25004V18.3334C19.25 18.8196 19.0568 19.2859 18.713 19.6297C18.3692 19.9736 17.9029 20.1667 17.4167 20.1667H13.75" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="str active" d="M8.25 20.1667V11H13.75V20.1667" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div class="text active">Houses</div>
                        </a>
                        <a class="menu">
                            <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="str" d="M16.5834 19.25V17.4167C16.5834 16.4442 16.197 15.5116 15.5094 14.8239C14.8218 14.1363 13.8891 13.75 12.9167 13.75H5.58335C4.61089 13.75 3.67826 14.1363 2.99063 14.8239C2.303 15.5116 1.91669 16.4442 1.91669 17.4167V19.25" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="str" d="M9.24998 10.0833C11.275 10.0833 12.9166 8.44171 12.9166 6.41667C12.9166 4.39162 11.275 2.75 9.24998 2.75C7.22494 2.75 5.58331 4.39162 5.58331 6.41667C5.58331 8.44171 7.22494 10.0833 9.24998 10.0833Z" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="str" d="M22.0833 19.25V17.4166C22.0827 16.6042 21.8123 15.815 21.3146 15.1729C20.8168 14.5308 20.1199 14.0722 19.3333 13.8691" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="str" d="M15.6667 2.86914C16.4554 3.07108 17.1545 3.52978 17.6537 4.17293C18.1529 4.81607 18.4239 5.60707 18.4239 6.42122C18.4239 7.23538 18.1529 8.02638 17.6537 8.66952C17.1545 9.31266 16.4554 9.77136 15.6667 9.97331" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                
                            <div class="text">Committees</div>
                        </a>
                        <?php
                            if($m_complaint!=0){
                        ?>
                        <a href="../../pages/office_staff/need_request.php" class="menu">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="str" d="M11.3402 5.00297C11.3401 5.71796 11.0574 6.40391 10.5536 6.9113C9.39388 8.08054 8.26861 9.29969 7.06491 10.4262C6.93052 10.5486 6.75426 10.6147 6.5725 10.611C6.39075 10.6072 6.21738 10.5338 6.08816 10.406L2.62084 6.91249C2.11683 6.40477 1.83398 5.71838 1.83398 5.00297C1.83398 4.28756 2.11683 3.60117 2.62084 3.09345C2.87234 2.84009 3.17149 2.63901 3.50105 2.50179C3.83061 2.36457 4.18407 2.29393 4.54106 2.29393C4.89805 2.29393 5.25151 2.36457 5.58107 2.50179C5.91063 2.63901 6.20978 2.84009 6.46128 3.09345L6.58723 3.22059L6.71318 3.09345C7.09069 2.71186 7.57321 2.45124 8.09931 2.34476C8.62541 2.23828 9.1713 2.29077 9.66748 2.49553C10.1637 2.7003 10.5877 3.04808 10.8856 3.49461C11.1835 3.94113 11.3417 4.4662 11.3402 5.00297V5.00297Z" stroke="#1E1E1E" stroke-width="2" stroke-linejoin="round"/>
                                <path class="str" d="M19.4546 14.497L14.9107 19.0409C14.7771 19.1746 14.5959 19.2498 14.4069 19.25L6.28238 19.25C5.80966 19.25 5.35631 19.0622 5.02205 18.728C4.68779 18.3937 4.5 17.9403 4.5 17.4676C4.5 16.9949 4.68779 16.5416 5.02205 16.2073C5.35631 15.873 5.80966 15.6852 6.28238 15.6852L13.5133 15.6852" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="str" d="M14.7022 14.4973L13.6827 15.5168C13.6291 15.5703 13.5656 15.6128 13.4957 15.6417C13.4257 15.6707 13.3508 15.6856 13.2751 15.6855C13.0576 15.6855 12.8592 15.562 12.7606 15.3671L12.498 14.8407C12.275 14.3947 12.1979 13.8899 12.2777 13.3978C12.3574 12.9056 12.59 12.4509 12.9424 12.0982L14.0059 10.1963C14.4514 9.7506 15.0558 9.50013 15.686 9.5L19.4552 9.5" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                           
                            <div class="text">Need requests</div>
                        </a>
                        <?php
                            }else{}
                        ?>
                        <a href="../../pages/office_staff/change_password.php" class="menu">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="str" d="M17.4167 10.0835H4.58339C3.57087 10.0835 2.75006 10.9043 2.75006 11.9168V18.3335C2.75006 19.346 3.57087 20.1668 4.58339 20.1668H17.4167C18.4292 20.1668 19.2501 19.346 19.2501 18.3335V11.9168C19.2501 10.9043 18.4292 10.0835 17.4167 10.0835Z" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="str" d="M6.41681 10.0835V6.41683C6.41681 5.20125 6.89969 4.03547 7.75924 3.17592C8.61878 2.31638 9.78457 1.8335 11.0001 1.8335C12.2157 1.8335 13.3815 2.31638 14.241 3.17592C15.1006 4.03547 15.5835 5.20125 15.5835 6.41683V10.0835" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div class="text">Change password</div>
                        </a>
                    </div>
                    <div class="logout">
                        <a href="../../../controller/logout.php">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="str" d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path class="str" d="M16 17L21 12L16 7" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path class="str" d="M21 12H9" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="text">Logout</div>
                        </a>
                    </div>
                </div>
            </div>