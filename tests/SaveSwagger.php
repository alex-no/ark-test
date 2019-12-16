<?php

namespace Tests;

use RonasIT\Support\AutoDoc\Services\SwaggerService;

trait SaveSwagger
{
    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    protected function tearDown(): void
    {
        $currentTestCount = $this->getTestResultObject()->count();
        $allTestCount = $this->getTestResultObject()->topTestSuite()->count();

        if (($currentTestCount == $allTestCount) && (!$this->hasFailed())) {
            $autoDocService = app(SwaggerService::class);

            $autoDocService->saveProductionData();
        }

        parent::tearDown();
    }
}
