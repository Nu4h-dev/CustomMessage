<?php

namespace nu4h;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config

class main extends PluginBase implements Listener{
    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
      @mkdir($this->getDataFolder());
      if (!file_exists($this->getDataFolder())){
          $this->saveResource('config.yml');
      }
      $config = new Config($this->getDataFolder() . 'config.yml', Config::YAML, array(
          'join' => '%nameJust joined the server',
          'quit' => '%nameJust leave the server',
      ));
      $this->Join = $config->get('join');
      $this->quit = $config->get('quit');
    }
    public function onJoin(PlayerJoinEvent $event){
        $name = $event->getPlayer()->getName();
        $message = str_replace('%name', $name, $this->join);
        $event->setJoinMessage($message);
    }
    public function onQuit(PlayerQuitEvent $event){
        $name = $event->getPlayer()->getName();
        $message = str_replace('%name', $name, $this->quit);
        $event->setQuitMessage($message);
    }
}
