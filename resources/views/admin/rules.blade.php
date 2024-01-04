<?php

if (Session::has('name')) {
    if (time() - Session('attempt') > 43200) {
        Session::flush();
        return redirect()
            ->to('/adminPlace')
            ->with('timeout', 'session-timeout')
            ->send();
    }
} else {
    return redirect()
        ->to('/adminPlace')
        ->send();
}

?>
