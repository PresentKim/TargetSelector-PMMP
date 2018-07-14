<?php

/*
 *
 *  ____                           _   _  ___
 * |  _ \ _ __ ___  ___  ___ _ __ | |_| |/ (_)_ __ ___
 * | |_) | '__/ _ \/ __|/ _ \ '_ \| __| ' /| | '_ ` _ \
 * |  __/| | |  __/\__ \  __/ | | | |_| . \| | | | | | |
 * |_|   |_|  \___||___/\___|_| |_|\__|_|\_\_|_| |_| |_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author  PresentKim (debe3721@gmail.com)
 * @link    https://github.com/PresentKim
 * @license https://www.gnu.org/licenses/agpl-3.0.html AGPL-3.0.0
 *
 *   (\ /)
 *  ( . .) ♥
 *  c(")(")
 */

declare(strict_types=1);

namespace kim\present\targetselector\variable;

use pocketmine\command\CommandSender;

abstract class Variable{
	public const PERMISSION_PREFIX = "targetselector.";
	/** Permission of target selector variable */
	public const PERMISSION = self::PERMISSION_PREFIX . "";
	/** Identifier of target selector variable */
	public const IDENTIFIER = "";

	/**
	 * @param string        $command
	 * @param CommandSender $sender
	 *
	 * @return array
	 */
	public function parse(string $command, CommandSender $sender) : array{
		if($sender->hasPermission($this::PERMISSION)){
			return $this->onParse($command, $sender);
		}
	}

	/**
	 * @param string        $command
	 * @param CommandSender $sender
	 *
	 * @return array
	 */
	protected abstract function onParse(string $command, CommandSender $sender) : array;

	/**
	 * @param string $command
	 *
	 * @return bool
	 */
	public function identify(string $command) : bool{
		return (bool) preg_match("\@(?:" . $this::IDENTIFIER . "\s|" . $this::IDENTIFIER . "$)/i", $command, $matches);
	}

	/**
	 * @return string
	 */
	public function toString() : string{
		return "@" . $this::IDENTIFIER;
	}
}