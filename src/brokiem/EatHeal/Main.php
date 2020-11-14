<?php

namespace brokiem\EatHeal;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityRegainHealthEvent;
use pocketmine\event\player\PlayerItemConsumeEvent;

class Main extends PluginBase implements Listener {

  public function onEnable() {
    $this->saveDefaultConfig();
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
  }

  public function onHeal(EntityRegainHealthEvent $event){
    $entity = $event->getEntity();
    if($entity instanceof Player) {
      if($entity->hasPermission("eatheal.use")) {
        if($event->getRegainReason() === EntityRegainHealthEvent::CAUSE_SATURATION){
          $event->setCancelled();
        }
      }
    }
  }

  public function onConsume(PlayerItemConsumeEvent $event){
    $player = $event->getPlayer();
    if($player->hasPermission("eatheal.use")) {
      $player->setHealth($player->getHealth() + $this->getConfig()->get("healing", 3));
    }
  }

}
