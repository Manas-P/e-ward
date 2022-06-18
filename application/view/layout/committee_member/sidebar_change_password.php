<div class="sidebar" style="position: fixed;">
    <div class="brand">
        <img src="../../../../public/assets/images/logo.svg" alt="logo" srcset="">
        <div class="user"><?php echo $firstName; ?></div>
    </div>
    <div class="division"></div>
    <div class="links">
        <div class="menus">
            <a href="./dashboard.php" class="menu">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="str" d="M9.16667 2.75H2.75V9.16667H9.16667V2.75Z" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path class="str" d="M19.25 2.75H12.8333V9.16667H19.25V2.75Z" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path class="str" d="M19.25 12.8334H12.8333V19.25H19.25V12.8334Z" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path class="str" d="M9.16667 12.8334H2.75V19.25H9.16667V12.8334Z" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <div class="text">Dashboard</div>
            </a>
            <a href="./download_cert.php" class="menu">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="str" d="M13.4636 1.83328V5.72912C13.4636 5.98743 13.5662 6.23516 13.7488 6.41781C13.9315 6.60046 14.1792 6.70307 14.4375 6.70307H18.3334" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path class="str" d="M4.69794 6.70307V3.7812C4.69794 3.26458 4.90316 2.76912 5.26847 2.40381C5.63377 2.03851 6.12923 1.83328 6.64585 1.83328H13.4636L18.3334 6.70307V17.4166C18.3334 17.9332 18.1281 18.4287 17.7628 18.794C17.3975 19.1593 16.9021 19.3645 16.3854 19.3645H11.5156" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path class="str" d="M5.67188 15.4687C7.28558 15.4687 8.59375 14.1605 8.59375 12.5468C8.59375 10.9331 7.28558 9.62495 5.67188 9.62495C4.05817 9.62495 2.75 10.9331 2.75 12.5468C2.75 14.1605 4.05817 15.4687 5.67188 15.4687Z" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <line class="str" x1="9.56769" y1="9.12495" x2="15.4114" y2="9.12496" stroke="#1E1E1E"/>
                    <line class="str" x1="10.5417" y1="12.0468" x2="15.4115" y2="12.0468" stroke="#1E1E1E"/>
                    <path class="str" d="M4.21094 15.4687L2.75 20.3385L5.67187 18.8776L8.59375 20.3385L7.13281 15.4687" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <div class="text">Download certificate</div>
            </a>
            <a href="./change_password.php" class="menu active">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="str active" d="M17.4167 10.0835H4.58339C3.57087 10.0835 2.75006 10.9043 2.75006 11.9168V18.3335C2.75006 19.346 3.57087 20.1668 4.58339 20.1668H17.4167C18.4292 20.1668 19.2501 19.346 19.2501 18.3335V11.9168C19.2501 10.9043 18.4292 10.0835 17.4167 10.0835Z" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path class="str active" d="M6.41681 10.0835V6.41683C6.41681 5.20125 6.89969 4.03547 7.75924 3.17592C8.61878 2.31638 9.78457 1.8335 11.0001 1.8335C12.2157 1.8335 13.3815 2.31638 14.241 3.17592C15.1006 4.03547 15.5835 5.20125 15.5835 6.41683V10.0835" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <div class="text active">Change password</div>
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