<?php

namespace App\Classes\Data;


class LeaderboardsData extends Data
{
    /**
     * @param int $id_game
     * @param int $limit
     * @return array|bool
     */
    public function getTopPlayers(int $id_game, $limit = 10)
    {
        $validation_data = [
            'id_game' => $id_game,
            'limit' => $limit
        ];

        if (!$this->validate($validation_data)) {
            return false;
        }

        $data = $this->getCache()->zrevrange($id_game, 0, $limit - 1, 'WITHSCORES');

        $players = [];
        $rank = 0;
        $last_score = null;

        foreach ($data as $id_player => $score) {
            if ($score !== $last_score) {
                $rank++;
            }

            $players[] = [
                'rank' => $rank,
                'id_player' => $id_player,
                'score' => $score
            ];

            $last_score = $score;
        }

        return [
            'id_game' => $id_game,
            'players' => $players
        ];
    }

    /**
     * @param $data
     * @return bool
     */
    protected function validate($data)
    {
        $this->getValidator()->required('id_game')->integer(true)->greaterThan(0);
        $this->getValidator()->required('limit')->integer(true)->greaterThan(0);

        if (!parent::validate($data)) {
            $this->handleErrors();

            return false;
        }

        return true;
    }
}