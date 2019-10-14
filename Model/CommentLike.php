<?php

namespace Model;

use Manager\CommentManager;
use Manager\UserManager;

/**
 * Entity CommentLike
 */
class CommentLike
{
    private $_commentLikeId;
    private $_commentId;
    private $_userId;
    private $_published;

    public function __construct(array $array)
    {
        $this->hydrate($array);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            if (strpos($key, '_')) {
                $arrayKey = explode('_', $key);
                $key = $arrayKey[0] . ucfirst($arrayKey[1]);
                if (array_key_exists(2, $arrayKey)) {
                    $key = $arrayKey[0] . ucfirst($arrayKey[1]) . ucfirst($arrayKey[2]);
                }
            }
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function setCommentLikeId(int $id)
    {
        $this->_commentLikeId = $id;
    }

    public function getCommentLikeId()
    {
        return $this->_commentLikeId;
    }

    public function setCommentId(int $id)
    {
        $this->_commentId = $id;
    }

    public function getCommentId()
    {
        $comment = new CommentManager();

        return $comment->getCommentsLikesByCommentId($this->_commentLikeId);
    }

    public function setUserId(int $userId)
    {
        $this->_userId = $userId;
    }

    public function getUserId()
    {
        $user = new UserManager();

        return $user->getUserById($this->_userId);
    }

    public function setPublished($date)
    {
        $this->_published = $date;
    }

    public function getPublished()
    {
        return date_format(date_create($this->_published), 'd/m/Y à H:i');
    }
}