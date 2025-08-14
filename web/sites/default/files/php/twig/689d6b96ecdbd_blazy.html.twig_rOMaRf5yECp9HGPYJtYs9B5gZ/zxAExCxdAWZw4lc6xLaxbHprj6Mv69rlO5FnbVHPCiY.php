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

/* modules/contrib/blazy/templates/blazy.html.twig */
class __TwigTemplate_33e12ac0c99cf8abda1d4ea8baacdb70 extends Template
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
            'blazy_player' => [$this, 'block_blazy_player'],
            'blazy_media' => [$this, 'block_blazy_media'],
            'blazy_content' => [$this, 'block_blazy_content'],
            'blazy_caption' => [$this, 'block_blazy_caption'],
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 66
        $context["classes"] = [(((($tmp =         // line 67
($context["content"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("media--rendered") : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 68
($context["blazies"] ?? null), "namespace", [], "any", false, false, true, 68)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (("media--" . \Drupal\Component\Utility\Html::getClass(CoreExtension::getAttribute($this->env, $this->source, ($context["blazies"] ?? null), "namespace", [], "any", false, false, true, 68)))) : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 69
($context["blazies"] ?? null), "media", [], "any", false, false, true, 69), "provider", [], "any", false, false, true, 69)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (("media--" . \Drupal\Component\Utility\Html::getClass(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["blazies"] ?? null), "media", [], "any", false, false, true, 69), "provider", [], "any", false, false, true, 69)))) : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 70
($context["settings"] ?? null), "media_switch", [], "any", false, false, true, 70)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (("media--switch media--switch--" . \Drupal\Component\Utility\Html::getClass(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "media_switch", [], "any", false, false, true, 70)))) : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 71
($context["blazies"] ?? null), "use", [], "any", false, false, true, 71), "player", [], "any", false, false, true, 71)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("media--player") : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 72
($context["blazies"] ?? null), "media", [], "any", false, false, true, 72), "bundle", [], "any", false, false, true, 72)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (("media--bundle--" . \Drupal\Component\Utility\Html::getClass(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["blazies"] ?? null), "media", [], "any", false, false, true, 72), "bundle", [], "any", false, false, true, 72)))) : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 73
($context["blazies"] ?? null), "media", [], "any", false, false, true, 73), "type", [], "any", false, false, true, 73)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (("media--" . \Drupal\Component\Utility\Html::getClass(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["blazies"] ?? null), "media", [], "any", false, false, true, 73), "type", [], "any", false, false, true, 73)))) : ("")), (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 74
($context["blazies"] ?? null), "resimage", [], "any", false, false, true, 74), "id", [], "any", false, false, true, 74) &&  !($context["content"] ?? null))) ? ("media--responsive") : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 75
($context["blazies"] ?? null), "is", [], "any", false, false, true, 75), "svg", [], "any", false, false, true, 75)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("media--svg") : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 76
($context["settings"] ?? null), "ratio", [], "any", false, false, true, 76)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (("media--ratio media--ratio--" . CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "ratio", [], "any", false, false, true, 76))) : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 77
($context["blazies"] ?? null), "use", [], "any", false, false, true, 77), "loader", [], "any", false, false, true, 77)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("is-b-loading") : ("")), (((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 78
($context["settings"] ?? null), "classes", [], "any", false, false, true, 78)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (\Drupal\Component\Utility\Html::getClass(Twig\Extension\CoreExtension::join(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "classes", [], "any", false, false, true, 78), " "))) : (""))];
        // line 81
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["blazies"] ?? null), "use", [], "any", false, false, true, 81), "player", [], "any", false, false, true, 81)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 82
            yield "  ";
            $context["attributes"] = CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "setAttribute", ["aria-live", "polite"], "method", false, false, true, 82);
            // line 83
            yield "
  ";
            // line 84
            $context["label"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["blazies"] ?? null), "media", [], "any", false, false, true, 84), "label", [], "any", false, false, true, 84);
            // line 85
            yield "  ";
            $context["play_title"] = t("Load and play video.");
            // line 86
            yield "  ";
            $context["close_title"] = t("Stop and close video.");
            // line 87
            yield "
  ";
            // line 88
            if ((($tmp = ($context["label"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 89
                yield "    ";
                $context["play_title"] = t("Load and play the video \"@label\".", ["@label" => ($context["label"] ?? null)]);
                // line 90
                yield "    ";
                $context["close_title"] = t("Stop and close the video \"@label\".", ["@label" => ($context["label"] ?? null)]);
                // line 91
                yield "  ";
            }
            // line 92
            yield "
  ";
            // line 93
            $context["play_button_attributes"] = $this->extensions['Drupal\Core\Template\TwigExtension']->createAttribute(["aria-label" =>             // line 94
($context["play_title"] ?? null), "class" => ["media__icon", "media__icon--play"], "data-b-provider" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,             // line 96
($context["blazies"] ?? null), "media", [], "any", false, false, true, 96), "provider", [], "any", false, false, true, 96), "data-b-token" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,             // line 97
($context["blazies"] ?? null), "media", [], "any", false, false, true, 97), "token", [], "any", false, false, true, 97), "data-b-url" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,             // line 98
($context["blazies"] ?? null), "media", [], "any", false, false, true, 98), "embed_url", [], "any", false, false, true, 98), "data-iframe-title" =>             // line 99
($context["label"] ?? null), "title" =>             // line 100
($context["play_title"] ?? null), "type" => "button"]);
            // line 103
            yield "
  ";
            // line 104
            $context["close_button_attributes"] = $this->extensions['Drupal\Core\Template\TwigExtension']->createAttribute(["aria-label" =>             // line 105
($context["close_title"] ?? null), "class" => ["media__icon", "media__icon--close"], "title" =>             // line 107
($context["close_title"] ?? null), "type" => "button"]);
        }
        // line 111
        $context["player"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 112
            yield "  ";
            yield from $this->unwrap()->yieldBlock('blazy_player', $context, $blocks);
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 121
        $context["media"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 122
            yield from $this->unwrap()->yieldBlock('blazy_media', $context, $blocks);
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 136
        $context["blazy"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 137
            yield from $this->unwrap()->yieldBlock('blazy_content', $context, $blocks);
            // line 152
            yield "
  ";
            // line 154
            $context["IS_INLINE"] =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "inline", [], "any", false, false, true, 154));
            // line 155
            $context["IS_OVERLAY"] =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "overlay", [], "any", false, false, true, 155));
            // line 157
            if ((($context["IS_INLINE"] ?? null) || ($context["IS_OVERLAY"] ?? null))) {
                // line 158
                yield from $this->unwrap()->yieldBlock('blazy_caption', $context, $blocks);
            }
            // line 182
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["postscript"] ?? null), "html", null, true);
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 184
        if ((($tmp = ($context["wrapper_attributes"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 185
            $context["wrapper_tag"] = (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["blazies"] ?? null), "item", [], "any", false, true, true, 185), "wrapper_tag", [], "any", true, true, true, 185) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["blazies"] ?? null), "item", [], "any", false, false, true, 185), "wrapper_tag", [], "any", false, false, true, 185)))) ? (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["blazies"] ?? null), "item", [], "any", false, false, true, 185), "wrapper_tag", [], "any", false, false, true, 185)) : ("div"));
            // line 186
            yield "<";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["wrapper_tag"] ?? null), "html", null, true);
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["wrapper_attributes"] ?? null), "html", null, true);
            yield ">";
            // line 187
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["blazy"] ?? null), "html", null, true);
            // line 188
            yield "</";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["wrapper_tag"] ?? null), "html", null, true);
            yield ">
";
        } else {
            // line 190
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["blazy"] ?? null), "html", null, true);
        }
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["content", "blazies", "settings", "captions", "postscript", "wrapper_attributes", "iframe", "preface", "image", "noscript", "overlay", "icon", "media_attributes", "url", "url_attributes", "caption_wrapper_attributes", "caption_attributes", "caption_content_attributes"]);        yield from [];
    }

    // line 112
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_blazy_player(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 113
        yield "    ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["blazies"] ?? null), "use", [], "any", false, false, true, 113), "player", [], "any", false, false, true, 113)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 114
            yield "      <button";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["close_button_attributes"] ?? null), "html", null, true);
            yield "></button>
      <button";
            // line 115
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["play_button_attributes"] ?? null), "html", null, true);
            yield "></button>
    ";
        } else {
            // line 117
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["iframe"] ?? null), "html", null, true);
        }
        // line 119
        yield "  ";
        yield from [];
    }

    // line 122
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_blazy_media(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 123
        yield "    <div";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 123), "html", null, true);
        yield ">";
        // line 124
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["preface"] ?? null), "html", null, true);
        // line 125
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["image"] ?? null), "html", null, true);
        // line 127
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["noscript"] ?? null), "html", null, true);
        // line 129
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["content"] ?? null), "html", null, true);
        // line 130
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["overlay"] ?? null), "html", null, true);
        // line 131
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["player"] ?? null), "html", null, true);
        // line 132
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["icon"] ?? null), "html", null, true);
        // line 133
        yield "</div>";
        yield from [];
    }

    // line 137
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_blazy_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 138
        if ((($tmp = ($context["media_attributes"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "<div";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["media_attributes"] ?? null), "html", null, true);
            yield ">";
        }
        // line 139
        if ((($context["url"] ?? null) &&  !CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["blazies"] ?? null), "use", [], "any", false, false, true, 139), "player", [], "any", false, false, true, 139))) {
            // line 140
            yield "<a href=\"";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["url"] ?? null), "html", null, true);
            yield "\"";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["url_attributes"] ?? null), "html", null, true);
            yield ">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["media"] ?? null), "html", null, true);
            yield "</a>
        ";
            // line 142
            if ((($context["captions"] ?? null) &&  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "lightbox", [], "any", false, false, true, 142)))) {
                // line 143
                yield "<div class=\"litebox__caption visually-hidden\">";
                // line 144
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "lightbox", [], "any", false, false, true, 144), "html", null, true);
                // line 145
                yield "</div>";
            }
        } else {
            // line 148
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["media"] ?? null), "html", null, true);
        }
        // line 150
        if ((($tmp = ($context["media_attributes"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "</div>";
        }
        yield from [];
    }

    // line 158
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_blazy_caption(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 159
        $context["caption_tag"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "tag", [], "any", true, true, true, 159) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "tag", [], "any", false, false, true, 159)))) ? (CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "tag", [], "any", false, false, true, 159)) : ("div"));
        // line 160
        $context["cw_tag"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "wrapper_tag", [], "any", true, true, true, 160) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "wrapper_tag", [], "any", false, false, true, 160)))) ? (CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "wrapper_tag", [], "any", false, false, true, 160)) : ("div"));
        // line 161
        $context["IS_CATEGORY"] =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "category", [], "any", false, false, true, 161));
        // line 163
        if ((($tmp = ($context["caption_wrapper_attributes"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "<";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["cw_tag"] ?? null), "html", null, true);
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["caption_wrapper_attributes"] ?? null), "html", null, true);
            yield ">";
        }
        // line 165
        yield "<";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["caption_tag"] ?? null), "html", null, true);
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["caption_attributes"] ?? null), "html", null, true);
        yield ">";
        // line 166
        if ((($tmp = ($context["IS_OVERLAY"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 167
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "overlay", [], "any", false, false, true, 167), "html", null, true);
            // line 168
            if ((($tmp = ($context["IS_INLINE"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "<div";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["caption_content_attributes"] ?? null), "html", null, true);
                yield ">";
            }
        }
        // line 171
        if ((($tmp = ($context["IS_INLINE"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "inline", [], "any", false, false, true, 171), "html", null, true);
        }
        // line 173
        if ((($context["IS_INLINE"] ?? null) && ($context["IS_OVERLAY"] ?? null))) {
            yield "</div>";
        }
        // line 174
        yield "</";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["caption_tag"] ?? null), "html", null, true);
        yield ">";
        // line 176
        if ((($tmp = ($context["IS_CATEGORY"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "category", [], "any", false, false, true, 176), "html", null, true);
        }
        // line 178
        if ((($tmp = ($context["caption_wrapper_attributes"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "</";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["cw_tag"] ?? null), "html", null, true);
            yield ">";
        }
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "modules/contrib/blazy/templates/blazy.html.twig";
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
        return array (  322 => 178,  318 => 176,  314 => 174,  310 => 173,  306 => 171,  299 => 168,  297 => 167,  295 => 166,  290 => 165,  283 => 163,  281 => 161,  279 => 160,  277 => 159,  270 => 158,  263 => 150,  260 => 148,  256 => 145,  254 => 144,  252 => 143,  250 => 142,  241 => 140,  239 => 139,  233 => 138,  226 => 137,  221 => 133,  219 => 132,  217 => 131,  215 => 130,  213 => 129,  211 => 127,  209 => 125,  207 => 124,  203 => 123,  196 => 122,  191 => 119,  188 => 117,  183 => 115,  178 => 114,  175 => 113,  168 => 112,  161 => 190,  155 => 188,  153 => 187,  148 => 186,  146 => 185,  144 => 184,  140 => 182,  137 => 158,  135 => 157,  133 => 155,  131 => 154,  128 => 152,  126 => 137,  124 => 136,  120 => 122,  118 => 121,  113 => 112,  111 => 111,  108 => 107,  107 => 105,  106 => 104,  103 => 103,  101 => 100,  100 => 99,  99 => 98,  98 => 97,  97 => 96,  96 => 94,  95 => 93,  92 => 92,  89 => 91,  86 => 90,  83 => 89,  81 => 88,  78 => 87,  75 => 86,  72 => 85,  70 => 84,  67 => 83,  64 => 82,  62 => 81,  60 => 78,  59 => 77,  58 => 76,  57 => 75,  56 => 74,  55 => 73,  54 => 72,  53 => 71,  52 => 70,  51 => 69,  50 => 68,  49 => 67,  48 => 66,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "modules/contrib/blazy/templates/blazy.html.twig", "/var/www/html/web/modules/contrib/blazy/templates/blazy.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["set" => 66, "if" => 81, "block" => 112];
        static $filters = ["clean_class" => 68, "join" => 78, "t" => 85, "escape" => 182];
        static $functions = ["create_attribute" => 93];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'block'],
                ['clean_class', 'join', 't', 'escape'],
                ['create_attribute'],
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
