<?php

namespace Asxer\Support\AutoDoc\Tests;

use Asxer\Support\AutoDoc\Services\SwaggerService;
use Asxer\Support\AutoDoc\Http\Middleware\AutoDocMiddleware;

trait AutoDocTestCaseTrait
{
    protected $docService;

    public function setUp(): void
    {
        parent::setUp();

        $this->docService = app(SwaggerService::class);
    }

    public function tearDown(): void
    {
        $currentTestCount = $this->getTestResultObject()->count();
        $allTestCount = $this->getTestResultObject()->topTestSuite()->count();

        if (($currentTestCount == $allTestCount) && (!$this->hasFailed())) {
            $this->docService->saveProductionData();
        }

        parent::tearDown();
    }

    /**
     * Disabling documentation collecting on current test
     */
    public function skipDocumentationCollecting()
    {
        AutoDocMiddleware::$skipped = true;
    }
}
