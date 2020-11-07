<?php

namespace brokiem\EatHeal;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityRegainHealthEvent;
use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {

  public function onEnable() {
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
  }

  public function onHeal(EntityRegainHealthEvent $event){
    $entity = $event->getEntity();
    if($entity instanceof Player) {
      if($entity->hasPermission("brokiem.eat.heal") {
        if($event->getRegainReason() === EntityRegainHealthEvent::CAUSE_SATURATION){
          $event->setCancelled();
        }
      }
    }
  }

  public function onConsume(PlayerItemConsumeEvent $event){
    $player = $event->getPlayer();
    $cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML, array(
      "healing" => 3
    ));
    if($player->hasPermission("brokiem.eat.heal") {
      $player->setHealth($player->getHealth() + (int) $cfg->get("healing"));
    }
  }
}
