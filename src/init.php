<?php

namespace init;

use DateTime;

session_start();
error_reporting(0);

class DiscordApi
{
    private $userId;
    private $ch;
    private $response;

    public function __construct()
    {
        $this->userId = $this->getJson('userId');

        if (isset($_GET['userId']) && $this->getJson('developmentMode')) {
            $userId = filter_input(INPUT_GET, 'userId', FILTER_VALIDATE_INT);
            if ($userId !== false) {
                $this->userId = $userId;
            }
        }

        $url = "https://api.fixed.ovh/api/discord/?id=" . $this->userId;

        $this->ch = curl_init($url);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        $this->response = curl_exec($this->ch);
    }

    public function getJson($field)
    {
        $data = json_decode(file_get_contents("../config.json"), true);

        return $data[$field];
    }

    public function getUserResource($field)
    {
        if (curl_errno($this->ch)) {
            $_SESSION['error'] = "API is not responding";
        } else {
            $userData = json_decode($this->response, true);
            $username = $userData[$field];

            if (isset($username)) {
                return $username;
            } else {
                $_SESSION['error'] = "no such user found";
            }
        }

        curl_close($this->ch);
    }

    public function avatar()
    {
        $avatar = $this->getUserResource('basic')['avatar'];
        $discriminator = $this->getUserResource('basic')['discriminator'];

        if ($avatar == null) {
            if ($discriminator == "0") {
                $number = ($this->userId >> 22) % 6;
                return 'https://cdn.discordapp.com/embed/avatars/' . $number . '.png';
            }

            $number = $discriminator % 5;
            return 'https://cdn.discordapp.com/embed/avatars/' . $number . '.png';
        }

        strcmp(substr($avatar, 0, 2), 'a_') == null ? $extension = '.gif' : $extension = '.png';
        return "https://cdn.discordapp.com/avatars/" . $this->userId . "/" . $avatar . $extension;
    }

    public function banner()
    {
        $banner = $this->getUserResource('basic')['banner'];
        $accent_color = $this->getUserResource('basic')['accentColor'];

        if ($banner == null) {
            if ($accent_color == null) {
                return;
            }

            return '#' . dechex($accent_color);
        }

        strcmp(substr($banner, 0, 2), 'a_') == null ? $extension = '.gif' : $extension = '.png';
        return "https://cdn.discordapp.com/banners/" . $this->userId . "/" . $banner . $extension . "?size=600";
    }

    public function createdAt()
    {
        $date = new DateTime($this->getUserResource('basic')['createdAt']);
        return $date->format('j F Y');
    }

    public function flags()
    {
        $flags = [
            0 => ["discordstaff", "Discord Staff"],
            1 => ["discordpartner", "Partnered Server Owner"],
            2 => ["hypesquadevents", "HypeSquad Events"],
            3 => ["discordbughunter1", "Discord Bug Hunter"],
            6 => ["hypesquadbravery", "HypeSquad Bravery"],
            7 => ["hypesquadbrilliance", "HypeSquad Brilliance"],
            8 => ["hypesquadbalance", "HypeSquad Balance"],
            9 => ["discordearlysupporter", "Early Supporter"],
            14 => ["discordbughunter2", "Discord Bug Hunter"],
            17 => ["discordbotdev", "Early Verified Bot Developer"],
            18 => ["discordmod", "Moderator Programs Alumni"],
            22 => ["activedeveloper", "Active Developer"],
        ];

        $activatedFlags = '';

        foreach ($flags as $index => $description) {
            if ($this->getUserResource('basic')['flags'] & (1 << $index)) {
                $activatedFlags .= '<img alt="badge" src="assets/media/badges/' . $description[0] . '.svg" class="w-[1.25rem] sm:w-6 h-[1.25rem] sm:h-6" data-tippy-content="' . $description[1] . '">';
            }
        }

        return $activatedFlags;
    }

    public function premiumType()
    {
        if ($this->getUserResource("basic")["premiumType"] == !null) {
            return '<img alt="badge" src="assets/media/badges/discordnitro.svg" class="w-4 sm:w-6 h-4 sm:h-6" data-tippy-content="Nitro Subscriber">';
        }
    }

    public function activity()
    {
        $activities = $this->getUserResource("extended")["activities"];

        foreach ($activities as $activity) {
            $types[] = $activity['type'];
            $names[] = $activity['name'];
            $details[] = $activity['details'];
            $states[] = $activity['state'];
            $timestamps[] = $activity['timestamps'];
            $largeImages[] = $activity['assets']['largeImage'];
            $smallImages[] = $activity['assets']['smallImage'];
            $largeTexts[] = $activity['assets']['largeText'];
            $smallTexts[] = $activity['assets']['smallText'];
        }

        $nameOfTypes = [
            0 => "Playing",
            1 => "Streaming",
            2 => "Listening",
            3 => "Watching",
            4 => "Custom",
            5 => "Competing"
        ];

        for ($i = 0; $i < count($names); $i++) {
            if ($largeImages[$i] == null) {
                $largeImages[$i] = '<div></div>';
            } else {
                if (substr($largeImages[$i], 0, 3) == "mp:") {
                    $largeImages[$i] = '<img alt="activity" class="w-[90px] rounded-lg" src="https://media.discordapp.net/' . str_replace('mp:', '', $largeImages[$i]) . '"' . (!empty($largeTexts[$i]) ? ' data-tippy-content="' . $largeTexts[$i] . '"' : '') . '>';
                } elseif (substr($largeImages[$i], 0, 8) == "spotify:") {
                    $largeImages[$i] = '<img alt="activity" class="w-[90px] rounded-lg" src="https://i.scdn.co/image/' . str_replace('spotify:', '', $largeImages[$i]) . '"' . (!empty($largeTexts[$i]) ? ' data-tippy-content="' . $largeTexts[$i] . '"' : '') . '>';
                } else {
                    $largeImages[$i] = '<img alt="activity" class="w-[90px] rounded-lg" src="https://cdn.discordapp.com/app-assets/383226320970055681/' . $largeImages[$i] . '"' . (!empty($largeTexts[$i]) ? ' data-tippy-content="' . $largeTexts[$i] . '"' : '') . '>';
                }
            }

            if ($smallImages[$i] == null) {
                $smallImages[$i] = '<div></div>';
            } else {
                if (substr($smallImages[$i], 0, 3) == "mp:") {
                    $smallImages[$i] = '<img alt="activity" class="w-[30px]  rounded-full absolute -bottom-1 -right-1" src="https://media.discordapp.net/' . str_replace('mp:', '', $smallImages[$i]) . '" data-tippy-content="' . $smallTexts[$i] . '">';
                } else {
                    $smallImages[$i] = '<img alt="activity" class="w-[30px] rounded-full absolute -bottom-1 -right-1" src="https://cdn.discordapp.com/app-assets/383226320970055681/' . $smallImages[$i] . '" data-tippy-content="' . $smallTexts[$i] . '">';
                }
            }

            $type = $nameOfTypes[$types[$i]];

            echo <<<EOL
             <div class="user-game py-4  max-w-64 sm:max-w-none">
             <h1 class="mb-2 uppercase text-gray-100 text-xs font-bold relative">$type</h1>
             <div class="flex items-center">
             <div class="relative self-start">
             $largeImages[$i]
             $smallImages[$i]
             </div>
             <div class="ml-[10px] text-gray-300 text-sm break-words">
             <div class="user-activity-name font-semibold">$names[$i]</div>
             <div class="user-activity-datails">$details[$i]</div>
             <div class="user-activity-state">$states[$i]</div>
             <div class="user-activity-timestamp"></div>
             </div>
             </div>
             </div>
            EOL;
        }

        $timestamps_json = json_encode($timestamps);
        echo <<<EOL
        <script type="text/javascript"> 
        timestamps = $timestamps_json;
        </script>
        EOL;
    }

    public function clientStatus()
    {
        $clientStatus = $this->getUserResource("extended")["clientStatus"];
        $priorityOrder = ['desktop', 'web', 'mobile'];
        $finalStatus = 'offline';

        foreach ($priorityOrder as $device) {
            if (isset($clientStatus[$device]) && $clientStatus[$device] !== 'offline') {
                $finalStatus = $clientStatus[$device];
                break;
            }
        }

        return $finalStatus;
    }

    public function accounts()
    {
        $accountsData = $this->getJson('accounts');

        $output = '';

        foreach ($accountsData as $accountName => $account) {
            $username = $account["username"];
            $link = $account["link"];

            if ($username !== "" || $link !== "") {
                $output .= <<<EOL
                <div class="py-3 sm:px-2 px-1 text-base text-white border-[1px] border-discord-200 rounded-[4px] max-w-[125px] sm:max-w-[265px]">
                    <div class="flex items-center sm:gap-2 gap-1">
                        <img alt="$accountName" src="assets/media/accounts/$accountName.svg" class="user-service-icon w-6 float-left mr-1" data-tippy-content="$accountName">
                        <div class="flex items-center grow">
                            <div class="flex items-center flex-1 ">
                                <div class="user-service-name sm:text-base text-xs">
                                    {$account["username"]}
                                </div>
                            </div>
                            <a class="user-linked-account-OpenIco  rotate-45" href="$link">
                                <svg class="text-gray-400 hover:text-gray-200 " aria-hidden="true" role="img" width="24" height="24" viewBox="0 0 24 24">
                                    <polygon fill="currentColor" fill-rule="nonzero" points="13 20 11 20 11 8 5.5 13.5 4.08 12.08 12 4.16 19.92 12.08 18.5 13.5 13 8">
                                    </polygon>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            EOL;
            }
        }

        return $output;
    }
}
