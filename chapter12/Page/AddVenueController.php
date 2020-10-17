<?php


class AddVenueController extends PageController
{

    public function process()
    {
        $request = $this->getRequest();

        try {
            $name = $request->getProperty('venue_name');

            if (is_null($request->getProperty('submitted'))) {
                $request->addFeedback("choose a name for the venue");
                $this->render(__DIR__.'/view/add_venue.php', $request);
            } elseif (is_null($name)) {
                $request->addFeedback("name is a required field");
                $this->render(__DIR__.'/view/add_venue.php', $request);

                return;
            } else
                $this->forward('listvenues.php');
        } catch (Exception $e) {
            $this->render(__DIR__.'/view/error.php', $request);
        }
    }
}