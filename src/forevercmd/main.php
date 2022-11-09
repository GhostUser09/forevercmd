<?php

namespace ForeverCMD;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\Event;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\GameMode;
use pocketmine\Player;
use pocketmine\utils\Config;

class main extends PluginBase implements Listener
{
    public function onEnable(): void
    {
        $this->getLogger()->getInfo("ForeverCMD is activated!");
        $this->getServer()->getPluginManager()->registerEvent($this, $this);
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->getResource("config.yml");
    }
    public function onPlayerJoin(PlayerJoinEvent $event)
    {
        $join = $this->getConfig()->get("join");
        $player = $this->getPlayer()->getName();
        $event->setJoinMessage(str_replace("{name}",$player,$join));
    }
    public function onPlayerQuit(PlayerQuitEvent $event)
    {
        $quit = $this->getConfig()->get("leave");
        $player = $this->getPlayer()->getName();
        $event->setQuitMessage(str_replace("{name}",$player,$quit));
    }
    public function onCommand(Command $cmd, CommandSender $sender, Array $args, String $label): bool
    {
        switch($cmd)
        {
            if($sender->hasPermission("fcmd.switch"))
            {
                case "gm0":
                $sender->setGameMode(GameMode::SURVIVAL());
                $sender->sendMessage("Du wurdest in den Überlebensmodus gesetzt!");
                break;
                case "gm1":
                $sender->setGameMode(GameMode::CREATIVE());
                $sender->sendMessage("Du wurdest in den Kreativmodus gesetzt!");
                break;
                case "gm2":
                $sender->setGameMode(GameMode::ADVENTURE());
                $sender->sendMessage("Du wurdest in den Abenteuermodus gesetzt!");
                break;
                case "gm3":
                $sender->setGameMode(GameMode::SPECTATOR());
                $sender->sendMessage("Du wurdest in den Zuschauermodus gesetzt!");
                break;
                case "isenabled":
                $sender->sendMessage("ForeverCMD is activated!");
                break;
            } else {
                $sender->sendMessage("Dir fehlt die Berechtigung dazu!");
            }
        }return true;
    }
}