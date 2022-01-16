<?php

namespace Sociant\AckeeAnalytics;

use Kirby\Cms\Page;

class AckeeInstance {

    /**
     * @var AckeeInstance[]
     */
    protected static $ackeeInstances = [];

    private Page $page;

    public function __construct(Page $page) {
        $this->page = $page;

        static::$ackeeInstances[$page->id()] = $this;
    }

    public static function instance(Page $page) {
        return static::$ackeeInstances[$page->id()] ?? new static($page);
    }

    public function renderHeader($options = []) {
        $isEnabled = isset($options['isEnabled']) ? $options['isEnabled'] : $this->page->ackeeTracking()->or(option('sociant.ackee-analytics.enable-tracking'))->isTrue();
        if(!$isEnabled) return null;

        $trackerFileName = isset($options['trackerFileName']) ? $options['trackerFileName'] : $this->page->ackeeTrackerFileName()->or(option('sociant.ackee-analytics.tracker-file-name'))->html();
        
        $analyticsUrl = isset($options['analyticsUrl']) ? $options['analyticsUrl'] : $this->page->ackeeAnalyticsUrl()->or(option('sociant.ackee-analytics.ackee-analytics-url'))->html();
        $domainId = isset($options['domainId']) ? $options['domainId'] : $this->page->ackeeDomainId()->or(option('sociant.ackee-analytics.domain-id'))->html();
        $detailed = isset($options['detailed']) ? $options['detailed'] : $this->page->ackeeDetailedTracking()->or(option('sociant.ackee-analytics.detailed'))->isTrue();
        $ignoreLocalhost = isset($options['ignoreLocalhost']) ? $options['ignoreLocalhost'] : $this->page->ackeeIgnoreLocalhost()->or(option('sociant.ackee-analytics.ignore-localhost'))->isTrue();
        $ignoreOwnVisits = isset($options['ignoreOwnVisits']) ? $options['ignoreOwnVisits'] : $this->page->ackeeIgnoreOwnVisits()->or(option('sociant.ackee-analytics.ignore-own-visits'))->isTrue();

        $ackeeOptions = [];

        if($detailed) $ackeeOptions['detailed'] = true;
        if(!$ignoreLocalhost) $ackeeOptions['ignoreLocalhost'] = false;
        if(!$ignoreOwnVisits) $ackeeOptions['ignoreOwnVisits'] = false;

        return '<script async src="' . $analyticsUrl . '/' . $trackerFileName .'" data-ackee-server="' . $analyticsUrl . '" data-ackee-domain-id="' . $domainId . '" data-ackee-opts="' . htmlspecialchars(json_encode($ackeeOptions)) . '"></script>';
    }

}