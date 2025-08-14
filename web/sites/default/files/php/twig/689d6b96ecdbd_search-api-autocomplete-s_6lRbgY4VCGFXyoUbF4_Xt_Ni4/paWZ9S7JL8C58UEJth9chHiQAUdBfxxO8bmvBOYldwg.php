<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* modules/contrib/search_api_autocomplete/templates/search-api-autocomplete-suggestion.html.twig */
class __TwigTemplate_3fe2100b46533abd455f676d5b0d7ff5 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 28
        yield "
<div class=\"search-api-autocomplete-suggestion\">
  ";
        // line 30
        if ((($tmp = ($context["note"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 31
            yield "    <span class=\"autocomplete-suggestion-note\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["note"] ?? null), "html", null, true);
            yield "</span>
  ";
        }
        // line 33
        yield "  ";
        if ((($tmp = ($context["label"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 34
            yield "    <span class=\"autocomplete-suggestion-label\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["label"] ?? null), "html", null, true);
            yield "</span>
  ";
        }
        // line 36
        yield "  ";
        $_v0 = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 37
            yield "    ";
            if ((($tmp = ($context["suggestion_prefix"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 38
                yield "      <span class=\"autocomplete-suggestion-suggestion-prefix\">";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["suggestion_prefix"] ?? null), "html", null, true);
                yield "</span>
    ";
            }
            // line 40
            yield "    ";
            if ((($tmp = ($context["user_input"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 41
                yield "      <span class=\"autocomplete-suggestion-user-input\">";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["user_input"] ?? null), "html", null, true);
                yield "</span>
    ";
            }
            // line 43
            yield "    ";
            if ((($tmp = ($context["suggestion_suffix"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 44
                yield "      <span class=\"autocomplete-suggestion-suggestion-suffix\">";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["suggestion_suffix"] ?? null), "html", null, true);
                yield "</span>
    ";
            }
            // line 46
            yield "  ";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 36
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(Twig\Extension\CoreExtension::spaceless($_v0));
        // line 47
        yield "  ";
        if ((($tmp = ($context["results_count"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 48
            yield "    <span class=\"autocomplete-suggestion-results-count\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["results_count"] ?? null), "html", null, true);
            yield "</span>
  ";
        }
        // line 50
        yield "</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["note", "label", "suggestion_prefix", "user_input", "suggestion_suffix", "results_count"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "modules/contrib/search_api_autocomplete/templates/search-api-autocomplete-suggestion.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  110 => 50,  104 => 48,  101 => 47,  99 => 36,  95 => 46,  89 => 44,  86 => 43,  80 => 41,  77 => 40,  71 => 38,  68 => 37,  65 => 36,  59 => 34,  56 => 33,  50 => 31,  48 => 30,  44 => 28,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "modules/contrib/search_api_autocomplete/templates/search-api-autocomplete-suggestion.html.twig", "/var/www/html/web/modules/contrib/search_api_autocomplete/templates/search-api-autocomplete-suggestion.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["if" => 30, "apply" => 36];
        static $filters = ["escape" => 31, "spaceless" => 36];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'apply'],
                ['escape', 'spaceless'],
                [],
                $this->source
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
