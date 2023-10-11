<?php

declare(strict_types=1);

namespace App\Model\Replicate\Response;

class Predictions
{

    /***
     * @var array<string, Prediction>
     */
    private array $predictions;

    /***
     * @var array<string, string>
     */
    private array $errors;

    /**
     * @return array<string, Prediction>
     */
    public function getPredictions(): array
    {
        return $this->predictions;
    }

    public function setPredictions(array $predictions): self
    {
        $this->predictions = $predictions;
        return $this;
    }

    public function addPrediction(string $key, Prediction $prediction): self
    {
        $this->predictions[$key] = $prediction;
        return $this;
    }

    public function removePrediction(string $key): self
    {
        unset($this->predictions[$key]);
        return $this;
    }

    /**
     * @return array<string, string>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setErrors(array $errors): self
    {
        $this->errors = $errors;
        return $this;
    }

    public function addError(string $key, string $error): self
    {
        $this->errors[$key] = $error;
        return $this;
    }
}
