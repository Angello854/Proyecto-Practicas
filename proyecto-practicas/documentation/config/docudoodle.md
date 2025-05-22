# Documentation: docudoodle.php

Original file: `config/docudoodle.php`

# Docudoodle Configuration Documentation

Table of Contents:

1. [Introduction](#introduction)
2. [OpenAI API Key](#openai-api-key)
3. [Claude API Key](#claude-api-key)
4. [Default Model](#default-model)
5. [Maximum Tokens](#maximum-tokens)
6. [Default Extensions](#default-extensions)
7. [Default Skip Directories](#default-skip-directories)
8. [Ollama Settings](#ollama-settings)
9. [Gemini API Key](#gemini-api-key)
10. [Azure OpenAI Settings](#azure-openai-settings)
11. [Default API Provider](#default-api-provider)
12. [Jira Settings](#jira-settings)
13. [Confluence Settings](#confluence-settings)
14. [Cache Settings](#cache-settings)
15. [Prompt Template](#prompt-template)

## Introduction

The `docudoodle.php` file is a configuration file for the Docudoodle application, which generates documentation from code. This file contains various settings that control how the application behaves and what information it extracts.

## OpenAI API Key

The `openai_api_key` setting is used to authenticate with the OpenAI API. You can obtain an API key from [OpenAI's website](https://platform.openai.com/account/api-keys).

### Example

```
'openai_api_key' => env('OPENAI_API_KEY', ''),
```

## Claude API Key

The `claude_api_key` setting is used to authenticate with the Claude API.

### Example

```
'claude_api_key' => env('CLAUDE_API_KEY', ''),
```

## Default Model

The `default_model` setting specifies the default model to use for generating documentation. This can be any of the models supported by OpenAI.

### Example

```
'default_model' => env('DOCUDOODLE_MODEL', 'gpt-4o-mini'),
```

## Maximum Tokens

The `max_tokens` setting specifies the maximum number of tokens to use for API calls. This controls how much information is extracted from code files.

### Example

```
'max_tokens' => env('DOCUDOODLE_MAX_TOKENS', 10000),
```

## Default Extensions

The `default_extensions` setting specifies the default file extensions to process. These are the types of files that Docudoodle will generate documentation for.

### Example

```
'default_extensions' => ['php', 'yaml', 'yml'],
```

## Default Skip Directories

The `default_skip_dirs` setting specifies the default directories to skip during processing. This is useful for excluding certain directories from being processed, such as vendor or test files.

### Example

```
'default_skip_dirs' => ['vendor/', 'node_modules/', 'tests/', 'cache/'],
```

## Ollama Settings

The `ollama_host` and `ollama_port` settings specify the host and port where Ollama is running. This is used for local API calls.

### Example

```
'ollama_host' => env('OLLAMA_HOST', 'localhost'),
'ollama_port' => env('OLLAMA_PORT', '11434'),
```

## Gemini API Key

The `gemini_api_key` setting is used to authenticate with the Gemini API.

### Example

```
'gemini_api_key' => env('GEMINI_API_KEY', ''),
```

## Azure OpenAI Settings

The `azure_endpoint`, `azure_api_key`, and `azure_deployment` settings specify the Azure OpenAI resource endpoint, API key, and deployment ID. This is used for Azure OpenAI integration.

### Example

```
'azure_endpoint' => env('AZURE_OPENAI_ENDPOINT', ''),
'azure_api_key' => env('AZURE_OPENAI_API_KEY', ''),
'azure_deployment' => env('AZURE_OPENAI_DEPLOYMENT', ''),
```

## Default API Provider

The `default_api_provider` setting specifies the default API provider to use for generating documentation. This can be one of several supported providers.

### Example

```
'default_api_provider' => env('DOCUDOODLE_API_PROVIDER', 'openai'),
```

## Jira Settings

The `jira` settings specify the Jira integration settings. These include whether or not to enable Jira, the Jira instance URL, API token, email, project key, and issue type.

### Example

```
'jira' => [
    'enabled' => env('DOCUDOODLE_JIRA_ENABLED', false),
    'host' => env('JIRA_HOST', ''),
    'api_token' => env('JIRA_API_TOKEN', ''),
    'email' => env('JIRA_EMAIL', ''),
    'project_key' => env('JIRA_PROJECT_KEY', ''),
    'issue_type' => env('JIRA_ISSUE_TYPE', 'Documentation'),
],
```

## Confluence Settings

The `confluence` settings specify the Confluence integration settings. These include whether or not to enable Confluence, the Confluence instance URL, API token, email, space key, and parent page ID.

### Example

```
'confluence' => [
    'enabled' => env('DOCUDOODLE_CONFLUENCE_ENABLED', false),
    'host' => env('CONFLUENCE_HOST', ''),
    'api_token' => env('CONFLUENCE_API_TOKEN', ''),
    'email' => env('CONFLUENCE_EMAIL', ''),
    'space_key' => env('CONFLUENCE_SPACE_KEY', ''),
    'parent_page_id' => env('CONFLUENCE_PARENT_PAGE_ID', ''),
],
```

## Cache Settings

The `use_cache` setting controls whether or not to use caching. The `cache_file_path` setting specifies the path to the cache file, and the `bypass_cache` setting allows you to force regeneration of all documents even if they haven't changed.

### Example

```
'use_cache' => env('DOCUDOODLE_USE_CACHE', true),
'cache_file_path' => env('DOCUDOODLE_CACHE_PATH', null),
'bypass_cache' => env('DOCUDOODLE_BYPASS_CACHE', false),
```

## Prompt Template

The `prompt_template` setting specifies the path to the prompt template file. This is used as a starting point for generating documentation.

### Example

```
'prompt_template' => env('DOCUDOODLE_PROMPT_TEMPLATE', __DIR__.'/../../resources/templates/default-prompt.md'),
```