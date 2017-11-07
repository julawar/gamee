<?php

namespace App\Classes\Data;


class ScoresData extends Data
{
    public function saveScore(int $id_game, int $id_player, int $score)
    {
        $data = [
            'id_game' => $id_game,
            'id_player' => $id_player,
            'score' => $score
        ];

        if (!$this->validate($data)) {
            return false;
        }

        $this->getCache()->zadd($id_game, $score, $id_player);

        return $data;
    }

    /**
     * @param $data
     * @return bool
     */
    protected function validate($data)
    {
        $this->getValidator()->required('id_game')->integer(true)->greaterThan(0);
        $this->getValidator()->required('id_player')->integer(true)->greaterThan(0);
        $this->getValidator()->required('score')->integer(true);

        if (!parent::validate($data)) {
            $this->handleErrors();

            return false;
        }

        return true;
    }
}