<?php

function autoversion($asset) {
  return asset($asset) . '?' . time();
}
