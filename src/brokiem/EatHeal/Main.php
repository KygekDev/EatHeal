<?php

namespace brokiem\EatHeal;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\PlayerItemConsumeEvent;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {

  public function onEnable() {
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML, array(
      "healing" => 3
    ));
  }

  public function onConsume(PlayerItemConsumeEvent $event){
    $player = $event->getPlayer();
    $player->setHealth($player->getHealth() + (int) $cfg->get("healing") ? 3);
  }
}
