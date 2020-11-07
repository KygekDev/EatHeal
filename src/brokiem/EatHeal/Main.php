<?php

namespace brokiem\EatHeal;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityRegainHealthEvent;
use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {

  public function onEnable() {
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML, array(
      "healing" => 3
    ));
  }

  public function onHeal(EntityRegainHealthEvent $event){
    if($event->getRegainReason() === EntityRegainHealthEvent::CAUSE_SATURATION){
      $event->setCancelled();
    }
  }

  public function onConsume(PlayerItemConsumeEvent $event){
    $player = $event->getPlayer();
    $player->setHealth($player->getHealth() + (int) $this->cfg->get("healing"));
  }
}
