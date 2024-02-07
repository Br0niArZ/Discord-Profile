<?php

require_once __DIR__ . '/init.php';

use init\DiscordApi;

$DiscordApi = new DiscordApi();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Discord profile with automated data retrieval via official API">
    <meta name="keywords" content="discord-profile">
    <meta name="author" content="fiXed & Br0niArZ">
    <meta name="copyright" content="(c) 2024 Br0niArZ">
    <meta name="robots" content="index,follow">
    <title>Discord Profile Card</title>
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/media/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/media/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/media/favicons/favicon-16x16.png">
    <link rel="manifest" href="./assets/media/favicons/site.webmanifest">
    <!-- css -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/font/gg sans/stylesheet.css">
    <!-- js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <script src="./assets/js/App.js"></script>
</head>

<body class="bg-discord-100">


    <div class="relative min-h-screen flex flex-col justify-between items-center content-center flex-wrap">
        <div class="text-white m-3 mt-1 sm:mb-10 text-center  <?php if ($DiscordApi->getJson("developmentMode") == false) echo 'invisible' ?>">
            <a href="https://github.com/Br0niArZ/Discord-Profile" target="_blank"> <button class="my-2 mr-2 bg-gradient-to-b bg-[#ddd] from-[#fcfcfc] to-[#dfdfdf] border-[1px] border-[#d5d5d5] hover:from-[#ddd] hover:to-[#ccc] hover:border-[#bbb] text-[#333] font-bold  rounded p-1 text-xl ">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="inline-block mb-1">
                        <path fill="#333" fill-rule="evenodd" clip-rule="evenodd" d="M12.0001 2.00001C9.62368 1.99759 7.32411 2.84152 5.51345 4.38057C3.70279 5.91961 2.49939 8.05316 2.1189 10.3989C1.73842 12.7446 2.20572 15.1491 3.43706 17.1816C4.66841 19.2141 6.58331 20.7416 8.8386 21.4905C9.34198 21.5826 9.52 21.2695 9.52 21.0055V19.3051C6.72688 19.9128 6.13756 17.9607 6.13756 17.9607C5.95226 17.3557 5.5586 16.8359 5.02645 16.4936C4.12406 15.8797 5.10012 15.8797 5.10012 15.8797C5.41644 15.9244 5.71846 16.0404 5.98328 16.2191C6.24811 16.3978 6.46881 16.6344 6.62866 16.911C6.76449 17.1573 6.94761 17.3743 7.16752 17.5497C7.38743 17.725 7.6398 17.8552 7.91015 17.9328C8.18049 18.0103 8.4635 18.0337 8.74292 18.0017C9.02234 17.9696 9.29268 17.8827 9.53842 17.7459C9.57695 17.2409 9.79466 16.7662 10.1523 16.4076C7.93007 16.1559 5.59735 15.2965 5.59735 11.4966C5.58209 10.504 5.94915 9.54349 6.62252 8.814C6.32262 7.95091 6.35767 7.00668 6.72074 6.16821C6.72074 6.16821 7.56175 5.8981 9.47089 7.19338C11.1103 6.74326 12.8407 6.74326 14.4801 7.19338C16.3892 5.8981 17.2241 6.16821 17.2241 6.16821C17.5922 6.99781 17.6361 7.93527 17.3469 8.79558C18.0203 9.52507 18.3873 10.4856 18.3721 11.4782C18.3721 15.3211 16.0332 16.1621 13.8048 16.3892C14.0438 16.6294 14.2283 16.9181 14.3459 17.2359C14.4634 17.5536 14.5113 17.8929 14.4862 18.2308V20.9748C14.4862 21.3002 14.6643 21.5519 15.1738 21.4537C17.4034 20.685 19.2896 19.1531 20.4992 17.1286C21.7088 15.104 22.164 12.7171 21.7842 10.3895C21.4045 8.06189 20.2143 5.94338 18.424 4.40825C16.6336 2.87311 14.3583 2.02013 12.0001 2.00001Z" fill="white" />
                    </svg>
                    View on GitHub</button></a>
            <div class="inline-block "> Demo profiles:
                <a class="mx-1 text-[#8ab4f8] hover:underline hover:text-blue-400" href="?userId=443456076244058142">fiXed</a> |
                <a class="ml-1 mr-3 text-[#8ab4f8] hover:underline hover:text-blue-400" href="?userId=497798316629950464">Br0niArZ-_-</a>
            </div>
            <form class="inline-block" method="get">
                <div class="inline-block text-nowrap mt-1">Try on you: <input name="userId" type="text" placeholder="Your user ID" class="bg-[#eee] rounded ml-1 text-black px-1 border border-gray-300 outline-none  focus:border-gray-400">
                    <svg data-tippy-content="You must be on our Discord!" class="outline-none inline-block w-7 mb-1 p-2 fill-slate-50 hover:fill-slate-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path class="" d="M80 160c0-35.3 28.7-64 64-64h32c35.3 0 64 28.7 64 64v3.6c0 21.8-11.1 42.1-29.4 53.8l-42.2 27.1c-25.2 16.2-40.4 44.1-40.4 74V320c0 17.7 14.3 32 32 32s32-14.3 32-32v-1.4c0-8.2 4.2-15.8 11-20.2l42.2-27.1c36.6-23.6 58.8-64.1 58.8-107.7V160c0-70.7-57.3-128-128-128H144C73.3 32 16 89.3 16 160c0 17.7 14.3 32 32 32s32-14.3 32-32zm80 320a40 40 0 1 0 0-80 40 40 0 1 0 0 80z" />
                    </svg>
                </div>

            </form>
        </div>
        <div class="pb-5">
            <div id="user-profile-card" class="select-none bg-discord-200   rounded-lg font-ggsans flex flex-col max-w-[600px] ">
                <header class="sm:mb-[60px] mb-10  sm:min-w-[600px]  w-80  ">
                    <div id="user-banner" class=" min-h-14 sm:min-h-28 rounded-t-lg bg-center bg-cover bg-no-repeat" <?php echo strlen($DiscordApi->banner()) <= 7 ? 'style="background-color: ' . $DiscordApi->banner() . '"' : null; ?>>
                        <?php
                        echo strlen($DiscordApi->banner()) > 7 ? '<img src="' . $DiscordApi->banner() . '" class="w-full h-[130px] sm:h-[210px] object-cover rounded-t-lg" />' : null;
                        ?>
                    </div>
                    <div class="relative">
                        <div class="relative left-[11px] top-[-46px] sm:left-[22px] sm:top-[-68px]">
                            <!-- user avatar -->
                            <img id="user-avatar" src="<?php echo $DiscordApi->avatar(); ?>" class="absolute rounded-full border-[3px] sm:border-[6px] border-discord-200 w-[86px] sm:w-32" crossorigin="anonymous" <?php echo $DiscordApi->getUserResource('basic')['accentColor'] == null ? 'onload="getDominantColor(this)"' : ''; ?>>
                            <!-- user avatar decoration -->
                            <img id="user-avatar-decoration" src="<?php ?>" class=" absolute top-[-2px] left-[-2px] w-[68px]  sm:top-[-4px] sm:left-[-4px] sm:w-[136px]">
                            <img id="user-avatar-decoration" src="<?php ?>" class=" absolute top-[-2px] left-[-2px] w-[68px]  sm:top-[-4px] sm:left-[-4px] sm:w-[136px]">
                            <!-- user status -->
                            <div class="relative">
                                <img src="assets/media/statuses/<?php echo $DiscordApi->clientStatus(); ?>.svg" id="user-status" data-tippy-content=<?php
                                                                                                                                                    $statuses = [
                                                                                                                                                        "online" => "Online",
                                                                                                                                                        "idle" => "Idle",
                                                                                                                                                        "dnd" => "Do not disturb",
                                                                                                                                                        "offline" => "Offline"
                                                                                                                                                    ];

                                                                                                                                                    echo '"' . $statuses[$DiscordApi->clientStatus()] . '"';
                                                                                                                                                    ?> class="absolute left-[45px] top-[50px] sm:left-[78px] sm:top-[84px] scale-75 sm:scale-100">
                            </div>
                            <div class="hidden absolute z-50  break-words rounded-lg bg-discord-300 py-1.5 px-3 font-sans text-sm font-normal text-white after:content-[''] after:absolute after:ml-[-5px] after:border-[5px] after:border-solid after:border-[black_transparent_transparent_transparent] after:left-2/4 after:top-full">

                            </div>

                        </div>
                        <div class="absolute left-24 right-2 top-2 sm:left-40 sm:right-4 sm:top-4 flex items-start justify-between ">
                            <!-- user badges -->

                            <?php $discordFlags = $DiscordApi->flags() . $DiscordApi->premiumType(); ?>
                            <div id="user-badges" class="flex items-center flex-nowrap justify-start mr-4 min-h-[22px] <?= $discordFlags ? "py-[2px] px-1" : ""; ?> bg-discord-300 gap-[2px] rounded-lg">
                                <?= $discordFlags; ?>
                            </div>


                            <div class="flex items-center mr-2 sm:mr-0">
                                <a href="discord:https://discordapp.com/users/<?php echo $DiscordApi->getJson('userId'); ?>" class="flex justify-center items-center sm:h-8 h-7 min-w-3 sm:min-w-[60px]  :py-[4px] px-2 sm:px-4  relative text-white bg-discordBtn-100 hover:bg-discordBtn-200 transition-colors	 rounded  text-xs sm:text-sm">
                                    <div>Send Message</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </header>
                <main class="bg-discord-300 min-h-[385px] m-4 rounded-lg flex flex-col relative overflow-hidden">
                    <div class="p-3 pb-0 text-white">
                        <div id="user-display-name" class="text-xl font-semibold"><?php if ($DiscordApi->getUserResource('basic')['globalName'] == null) {
                                                                                        echo 'Unknown Member';
                                                                                        $changeCss = true;
                                                                                    }
                                                                                    echo $DiscordApi->getUserResource('basic')['globalName']; ?></div>
                        <div id="user-username" class="text-sm font-semibold text-gray-400 <?php echo $changeCss == true ? "text-xl text-white" : null; ?>"><?php echo $DiscordApi->getUserResource('basic')['username']; ?></div>
                        <div id="user-pronouns" class="text-sm font-normal text-gray-300">
                            <?php echo $DiscordApi->getJson('pronous'); ?>
                        </div>
                    </div>
                    <div class="mx-3 mt-5 border-b-[1px] border-b-discord-200">
                        <div id="menu" class=" flex items-stretch gap-10 text-gray-400 text-sm font-medium">
                            <div menu-item="user-informations" onclick="showContent(this)" class="relative h-[39px] hover:text-white border-b-2 border-b-transparent hover:border-b-white cursor-pointer text-white border-b-white">
                                User Info
                            </div>
                            <div menu-item="user-activity" onclick="showContent(this)" class="<?php if ($DiscordApi->getUserResource("extended")["activities"][0]["name"] == null) echo "hidden"; ?> relative h-[39px] hover:text-white border-b-2 border-b-transparent hover:border-b-white cursor-pointer">
                                Activity
                            </div>
                        </div>
                        <script>
                            function showContent(item) {
                                let id = item.getAttribute('menu-item');
                                let elements = Array.from(document.getElementById('content').children);

                                document.querySelectorAll("#menu > div").forEach(function(div) {
                                    div.classList.remove('border-b-white', 'text-white');
                                });
                                item.classList.add('border-b-white', 'text-white');

                                elements.forEach(function(div) {
                                    div.style.display = 'none';
                                });

                                document.getElementById(id).style.display = 'block';
                            }
                        </script>

                    </div>

                    <!-- -->
                    <div id="content" class=" h-[244px]  pl-3 mr-[2px] pr-1 relative overflow-y-scroll scrollbar-height scrollbar-color scrollbar-thumb sm:invisible hover:visible focus:visible">

                        <div id="user-informations">
                            <div class="py-4 visible">
                                <h1 class="mb-2 text-xs font-bold uppercase text-white">
                                    About me
                                </h1>
                                <!-- User about Me -->
                                <div id="user-aboutMe" class="text-sm break-all text-gray-300 mb-4">
                                    <p>
                                        <?php foreach ($DiscordApi->getJson('bio') as $line) {
                                            echo $line . '<br>';
                                        } ?>
                                    </p>
                                </div>

                                <h1 class="mb-2 text-xs font-bold uppercase text-white">
                                    Discord member since
                                </h1>
                                <!-- User member since -->
                                <div id="user-member-since" class="mb-4 text-gray-300 text-sm">
                                    <?php echo $DiscordApi->createdAt(); ?>
                                </div>
                                <h1 class="mb-2 text-xs font-bold uppercase text-white">
                                    Note
                                </h1>
                                <div class="-m-1">
                                    <textarea id="user-note" aria-label="Notka" maxlength="256" placeholder="Kliknij, aby dodać notkę" onblur="this.placeholder = 'Kliknij aby dodać notkę'" onfocus="this.placeholder = ''" maxlength="256" autocorrect="off" class="h-11 p-1 resize-none bg-transparent outline-none text-sm text-gray-200 placeholder:text-gray-300 placeholder:font-light w-full overflow-hidden"></textarea>
                                </div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {

                                        var element = document.getElementById("user-note");
                                        element.value = localStorage.getItem("user-note");
                                        element.addEventListener("keyup", function() {
                                            localStorage.setItem("user-note", element.value);
                                        });

                                        element.addEventListener('keypress', function(e) {
                                            if (e.keyCode === 13 || e.which === 13) {
                                                e.preventDefault();
                                                return false;
                                            }
                                        });

                                    })
                                </script>
                            </div>

                            <div id="user-linked-accounts" class="border-t-[1px] border-t-discord-200 grid grid-flow-row grid-cols-2 visible gap-4 py-4">
                                <?php
                                echo $DiscordApi->accounts();
                                ?>
                            </div>
                        </div>
                        <div id="user-activity" style="display: none;">
                            <div id="user-activities" class="user-activity relative  visible">
                                <?php $DiscordApi->activity(); ?>
                            </div>
                        </div>

                    </div>
                </main>


            </div>
        </div>
        <footer class=" w-full  text-center text-discord-300 p-2 <?php if ($DiscordApi->getJson("developmentMode") == false) echo 'invisible' ?>"> 
            This page is not an official Discord website. The project is neither affiliated with nor endorsed by Discord Inc. Data is retrieved from Discord's public API, and there is no guarantee that it complies with official Discord standards. All trademarks belong to their respective owners.
        </footer>
    </div>
    <script>
        tippy('[data-tippy-content]', {
            theme: 'discord',
        });
    </script>
</body>

</html>