<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit949b6354a133bbf3c81dd503bfd714ad
{
    public static $files = array (
        'e69f7f6ee287b969198c3c9d6777bd38' => __DIR__ . '/..' . '/symfony/polyfill-intl-normalizer/bootstrap.php',
        'f598d06aa772fa33d905e87be6398fb1' => __DIR__ . '/..' . '/symfony/polyfill-intl-idn/bootstrap.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        'f864ae44e8154e5ff6f4eec32f46d37f' => __DIR__ . '/../..' . '/kirby/config/setup.php',
        '87988fc7b1c1f093da22a1a3de972f3a' => __DIR__ . '/../..' . '/kirby/config/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Whoops\\' => 7,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Intl\\Normalizer\\' => 33,
            'Symfony\\Polyfill\\Intl\\Idn\\' => 26,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'L' => 
        array (
            'Laminas\\Escaper\\' => 16,
        ),
        'K' => 
        array (
            'Kirby\\' => 6,
        ),
        'C' => 
        array (
            'Composer\\Semver\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Whoops\\' => 
        array (
            0 => __DIR__ . '/..' . '/filp/whoops/src/Whoops',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Polyfill\\Intl\\Normalizer\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-intl-normalizer',
        ),
        'Symfony\\Polyfill\\Intl\\Idn\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-intl-idn',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/src',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Laminas\\Escaper\\' => 
        array (
            0 => __DIR__ . '/..' . '/laminas/laminas-escaper/src',
        ),
        'Kirby\\' => 
        array (
            0 => __DIR__ . '/..' . '/getkirby/composer-installer/src',
            1 => __DIR__ . '/../..' . '/kirby/src',
        ),
        'Composer\\Semver\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/semver/src',
        ),
    );

    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/..' . '/league/color-extractor/src',
    );

    public static $prefixesPsr0 = array (
        'c' => 
        array (
            'claviska' => 
            array (
                0 => __DIR__ . '/..' . '/claviska/simpleimage/src',
            ),
        ),
        'M' => 
        array (
            'Michelf' => 
            array (
                0 => __DIR__ . '/..' . '/michelf/php-smartypants',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Composer\\Semver\\Comparator' => __DIR__ . '/..' . '/composer/semver/src/Comparator.php',
        'Composer\\Semver\\CompilingMatcher' => __DIR__ . '/..' . '/composer/semver/src/CompilingMatcher.php',
        'Composer\\Semver\\Constraint\\Bound' => __DIR__ . '/..' . '/composer/semver/src/Constraint/Bound.php',
        'Composer\\Semver\\Constraint\\Constraint' => __DIR__ . '/..' . '/composer/semver/src/Constraint/Constraint.php',
        'Composer\\Semver\\Constraint\\ConstraintInterface' => __DIR__ . '/..' . '/composer/semver/src/Constraint/ConstraintInterface.php',
        'Composer\\Semver\\Constraint\\MatchAllConstraint' => __DIR__ . '/..' . '/composer/semver/src/Constraint/MatchAllConstraint.php',
        'Composer\\Semver\\Constraint\\MatchNoneConstraint' => __DIR__ . '/..' . '/composer/semver/src/Constraint/MatchNoneConstraint.php',
        'Composer\\Semver\\Constraint\\MultiConstraint' => __DIR__ . '/..' . '/composer/semver/src/Constraint/MultiConstraint.php',
        'Composer\\Semver\\Interval' => __DIR__ . '/..' . '/composer/semver/src/Interval.php',
        'Composer\\Semver\\Intervals' => __DIR__ . '/..' . '/composer/semver/src/Intervals.php',
        'Composer\\Semver\\Semver' => __DIR__ . '/..' . '/composer/semver/src/Semver.php',
        'Composer\\Semver\\VersionParser' => __DIR__ . '/..' . '/composer/semver/src/VersionParser.php',
        'Kirby\\Api\\Api' => __DIR__ . '/../..' . '/kirby/src/Api/Api.php',
        'Kirby\\Api\\Collection' => __DIR__ . '/../..' . '/kirby/src/Api/Collection.php',
        'Kirby\\Api\\Model' => __DIR__ . '/../..' . '/kirby/src/Api/Model.php',
        'Kirby\\Blueprint\\Collection' => __DIR__ . '/../..' . '/kirby/src/Blueprint/Collection.php',
        'Kirby\\Blueprint\\Config' => __DIR__ . '/../..' . '/kirby/src/Blueprint/Config.php',
        'Kirby\\Blueprint\\Extension' => __DIR__ . '/../..' . '/kirby/src/Blueprint/Extension.php',
        'Kirby\\Blueprint\\Factory' => __DIR__ . '/../..' . '/kirby/src/Blueprint/Factory.php',
        'Kirby\\Blueprint\\Node' => __DIR__ . '/../..' . '/kirby/src/Blueprint/Node.php',
        'Kirby\\Blueprint\\NodeI18n' => __DIR__ . '/../..' . '/kirby/src/Blueprint/NodeI18n.php',
        'Kirby\\Blueprint\\NodeIcon' => __DIR__ . '/../..' . '/kirby/src/Blueprint/NodeIcon.php',
        'Kirby\\Blueprint\\NodeProperty' => __DIR__ . '/../..' . '/kirby/src/Blueprint/NodeProperty.php',
        'Kirby\\Blueprint\\NodeString' => __DIR__ . '/../..' . '/kirby/src/Blueprint/NodeString.php',
        'Kirby\\Blueprint\\NodeText' => __DIR__ . '/../..' . '/kirby/src/Blueprint/NodeText.php',
        'Kirby\\Cache\\ApcuCache' => __DIR__ . '/../..' . '/kirby/src/Cache/ApcuCache.php',
        'Kirby\\Cache\\Cache' => __DIR__ . '/../..' . '/kirby/src/Cache/Cache.php',
        'Kirby\\Cache\\FileCache' => __DIR__ . '/../..' . '/kirby/src/Cache/FileCache.php',
        'Kirby\\Cache\\MemCached' => __DIR__ . '/../..' . '/kirby/src/Cache/MemCached.php',
        'Kirby\\Cache\\MemoryCache' => __DIR__ . '/../..' . '/kirby/src/Cache/MemoryCache.php',
        'Kirby\\Cache\\NullCache' => __DIR__ . '/../..' . '/kirby/src/Cache/NullCache.php',
        'Kirby\\Cache\\Value' => __DIR__ . '/../..' . '/kirby/src/Cache/Value.php',
        'Kirby\\Cms\\Api' => __DIR__ . '/../..' . '/kirby/src/Cms/Api.php',
        'Kirby\\Cms\\App' => __DIR__ . '/../..' . '/kirby/src/Cms/App.php',
        'Kirby\\Cms\\AppCaches' => __DIR__ . '/../..' . '/kirby/src/Cms/AppCaches.php',
        'Kirby\\Cms\\AppErrors' => __DIR__ . '/../..' . '/kirby/src/Cms/AppErrors.php',
        'Kirby\\Cms\\AppPlugins' => __DIR__ . '/../..' . '/kirby/src/Cms/AppPlugins.php',
        'Kirby\\Cms\\AppTranslations' => __DIR__ . '/../..' . '/kirby/src/Cms/AppTranslations.php',
        'Kirby\\Cms\\AppUsers' => __DIR__ . '/../..' . '/kirby/src/Cms/AppUsers.php',
        'Kirby\\Cms\\AppUsersImpersonateProxy' => __DIR__ . '/../..' . '/kirby/src/Cms/AppUsersImpersonateProxy.php',
        'Kirby\\Cms\\Auth' => __DIR__ . '/../..' . '/kirby/src/Cms/Auth.php',
        'Kirby\\Cms\\Auth\\Challenge' => __DIR__ . '/../..' . '/kirby/src/Cms/Auth/Challenge.php',
        'Kirby\\Cms\\Auth\\EmailChallenge' => __DIR__ . '/../..' . '/kirby/src/Cms/Auth/EmailChallenge.php',
        'Kirby\\Cms\\Auth\\Status' => __DIR__ . '/../..' . '/kirby/src/Cms/Auth/Status.php',
        'Kirby\\Cms\\Block' => __DIR__ . '/../..' . '/kirby/src/Cms/Block.php',
        'Kirby\\Cms\\Blocks' => __DIR__ . '/../..' . '/kirby/src/Cms/Blocks.php',
        'Kirby\\Cms\\Blueprint' => __DIR__ . '/../..' . '/kirby/src/Cms/Blueprint.php',
        'Kirby\\Cms\\Collection' => __DIR__ . '/../..' . '/kirby/src/Cms/Collection.php',
        'Kirby\\Cms\\Collections' => __DIR__ . '/../..' . '/kirby/src/Cms/Collections.php',
        'Kirby\\Cms\\Content' => __DIR__ . '/../..' . '/kirby/src/Cms/Content.php',
        'Kirby\\Cms\\ContentLock' => __DIR__ . '/../..' . '/kirby/src/Cms/ContentLock.php',
        'Kirby\\Cms\\ContentLocks' => __DIR__ . '/../..' . '/kirby/src/Cms/ContentLocks.php',
        'Kirby\\Cms\\ContentTranslation' => __DIR__ . '/../..' . '/kirby/src/Cms/ContentTranslation.php',
        'Kirby\\Cms\\Core' => __DIR__ . '/../..' . '/kirby/src/Cms/Core.php',
        'Kirby\\Cms\\Email' => __DIR__ . '/../..' . '/kirby/src/Cms/Email.php',
        'Kirby\\Cms\\Event' => __DIR__ . '/../..' . '/kirby/src/Cms/Event.php',
        'Kirby\\Cms\\Field' => __DIR__ . '/../..' . '/kirby/src/Cms/Field.php',
        'Kirby\\Cms\\Fieldset' => __DIR__ . '/../..' . '/kirby/src/Cms/Fieldset.php',
        'Kirby\\Cms\\Fieldsets' => __DIR__ . '/../..' . '/kirby/src/Cms/Fieldsets.php',
        'Kirby\\Cms\\File' => __DIR__ . '/../..' . '/kirby/src/Cms/File.php',
        'Kirby\\Cms\\FileActions' => __DIR__ . '/../..' . '/kirby/src/Cms/FileActions.php',
        'Kirby\\Cms\\FileBlueprint' => __DIR__ . '/../..' . '/kirby/src/Cms/FileBlueprint.php',
        'Kirby\\Cms\\FileModifications' => __DIR__ . '/../..' . '/kirby/src/Cms/FileModifications.php',
        'Kirby\\Cms\\FilePermissions' => __DIR__ . '/../..' . '/kirby/src/Cms/FilePermissions.php',
        'Kirby\\Cms\\FilePicker' => __DIR__ . '/../..' . '/kirby/src/Cms/FilePicker.php',
        'Kirby\\Cms\\FileRules' => __DIR__ . '/../..' . '/kirby/src/Cms/FileRules.php',
        'Kirby\\Cms\\FileVersion' => __DIR__ . '/../..' . '/kirby/src/Cms/FileVersion.php',
        'Kirby\\Cms\\Files' => __DIR__ . '/../..' . '/kirby/src/Cms/Files.php',
        'Kirby\\Cms\\Find' => __DIR__ . '/../..' . '/kirby/src/Cms/Find.php',
        'Kirby\\Cms\\HasChildren' => __DIR__ . '/../..' . '/kirby/src/Cms/HasChildren.php',
        'Kirby\\Cms\\HasFiles' => __DIR__ . '/../..' . '/kirby/src/Cms/HasFiles.php',
        'Kirby\\Cms\\HasMethods' => __DIR__ . '/../..' . '/kirby/src/Cms/HasMethods.php',
        'Kirby\\Cms\\HasSiblings' => __DIR__ . '/../..' . '/kirby/src/Cms/HasSiblings.php',
        'Kirby\\Cms\\Helpers' => __DIR__ . '/../..' . '/kirby/src/Cms/Helpers.php',
        'Kirby\\Cms\\Html' => __DIR__ . '/../..' . '/kirby/src/Cms/Html.php',
        'Kirby\\Cms\\Ingredients' => __DIR__ . '/../..' . '/kirby/src/Cms/Ingredients.php',
        'Kirby\\Cms\\Item' => __DIR__ . '/../..' . '/kirby/src/Cms/Item.php',
        'Kirby\\Cms\\Items' => __DIR__ . '/../..' . '/kirby/src/Cms/Items.php',
        'Kirby\\Cms\\Language' => __DIR__ . '/../..' . '/kirby/src/Cms/Language.php',
        'Kirby\\Cms\\LanguageRouter' => __DIR__ . '/../..' . '/kirby/src/Cms/LanguageRouter.php',
        'Kirby\\Cms\\LanguageRoutes' => __DIR__ . '/../..' . '/kirby/src/Cms/LanguageRoutes.php',
        'Kirby\\Cms\\LanguageRules' => __DIR__ . '/../..' . '/kirby/src/Cms/LanguageRules.php',
        'Kirby\\Cms\\Languages' => __DIR__ . '/../..' . '/kirby/src/Cms/Languages.php',
        'Kirby\\Cms\\Layout' => __DIR__ . '/../..' . '/kirby/src/Cms/Layout.php',
        'Kirby\\Cms\\LayoutColumn' => __DIR__ . '/../..' . '/kirby/src/Cms/LayoutColumn.php',
        'Kirby\\Cms\\LayoutColumns' => __DIR__ . '/../..' . '/kirby/src/Cms/LayoutColumns.php',
        'Kirby\\Cms\\Layouts' => __DIR__ . '/../..' . '/kirby/src/Cms/Layouts.php',
        'Kirby\\Cms\\Loader' => __DIR__ . '/../..' . '/kirby/src/Cms/Loader.php',
        'Kirby\\Cms\\Media' => __DIR__ . '/../..' . '/kirby/src/Cms/Media.php',
        'Kirby\\Cms\\Model' => __DIR__ . '/../..' . '/kirby/src/Cms/Model.php',
        'Kirby\\Cms\\ModelPermissions' => __DIR__ . '/../..' . '/kirby/src/Cms/ModelPermissions.php',
        'Kirby\\Cms\\ModelWithContent' => __DIR__ . '/../..' . '/kirby/src/Cms/ModelWithContent.php',
        'Kirby\\Cms\\Nest' => __DIR__ . '/../..' . '/kirby/src/Cms/Nest.php',
        'Kirby\\Cms\\NestCollection' => __DIR__ . '/../..' . '/kirby/src/Cms/NestCollection.php',
        'Kirby\\Cms\\NestObject' => __DIR__ . '/../..' . '/kirby/src/Cms/NestObject.php',
        'Kirby\\Cms\\Page' => __DIR__ . '/../..' . '/kirby/src/Cms/Page.php',
        'Kirby\\Cms\\PageActions' => __DIR__ . '/../..' . '/kirby/src/Cms/PageActions.php',
        'Kirby\\Cms\\PageBlueprint' => __DIR__ . '/../..' . '/kirby/src/Cms/PageBlueprint.php',
        'Kirby\\Cms\\PagePermissions' => __DIR__ . '/../..' . '/kirby/src/Cms/PagePermissions.php',
        'Kirby\\Cms\\PagePicker' => __DIR__ . '/../..' . '/kirby/src/Cms/PagePicker.php',
        'Kirby\\Cms\\PageRules' => __DIR__ . '/../..' . '/kirby/src/Cms/PageRules.php',
        'Kirby\\Cms\\PageSiblings' => __DIR__ . '/../..' . '/kirby/src/Cms/PageSiblings.php',
        'Kirby\\Cms\\Pages' => __DIR__ . '/../..' . '/kirby/src/Cms/Pages.php',
        'Kirby\\Cms\\Pagination' => __DIR__ . '/../..' . '/kirby/src/Cms/Pagination.php',
        'Kirby\\Cms\\Permissions' => __DIR__ . '/../..' . '/kirby/src/Cms/Permissions.php',
        'Kirby\\Cms\\Picker' => __DIR__ . '/../..' . '/kirby/src/Cms/Picker.php',
        'Kirby\\Cms\\Plugin' => __DIR__ . '/../..' . '/kirby/src/Cms/Plugin.php',
        'Kirby\\Cms\\PluginAssets' => __DIR__ . '/../..' . '/kirby/src/Cms/PluginAssets.php',
        'Kirby\\Cms\\R' => __DIR__ . '/../..' . '/kirby/src/Cms/R.php',
        'Kirby\\Cms\\Responder' => __DIR__ . '/../..' . '/kirby/src/Cms/Responder.php',
        'Kirby\\Cms\\Response' => __DIR__ . '/../..' . '/kirby/src/Cms/Response.php',
        'Kirby\\Cms\\Role' => __DIR__ . '/../..' . '/kirby/src/Cms/Role.php',
        'Kirby\\Cms\\Roles' => __DIR__ . '/../..' . '/kirby/src/Cms/Roles.php',
        'Kirby\\Cms\\S' => __DIR__ . '/../..' . '/kirby/src/Cms/S.php',
        'Kirby\\Cms\\Search' => __DIR__ . '/../..' . '/kirby/src/Cms/Search.php',
        'Kirby\\Cms\\Section' => __DIR__ . '/../..' . '/kirby/src/Cms/Section.php',
        'Kirby\\Cms\\Site' => __DIR__ . '/../..' . '/kirby/src/Cms/Site.php',
        'Kirby\\Cms\\SiteActions' => __DIR__ . '/../..' . '/kirby/src/Cms/SiteActions.php',
        'Kirby\\Cms\\SiteBlueprint' => __DIR__ . '/../..' . '/kirby/src/Cms/SiteBlueprint.php',
        'Kirby\\Cms\\SitePermissions' => __DIR__ . '/../..' . '/kirby/src/Cms/SitePermissions.php',
        'Kirby\\Cms\\SiteRules' => __DIR__ . '/../..' . '/kirby/src/Cms/SiteRules.php',
        'Kirby\\Cms\\Structure' => __DIR__ . '/../..' . '/kirby/src/Cms/Structure.php',
        'Kirby\\Cms\\StructureObject' => __DIR__ . '/../..' . '/kirby/src/Cms/StructureObject.php',
        'Kirby\\Cms\\System' => __DIR__ . '/../..' . '/kirby/src/Cms/System.php',
        'Kirby\\Cms\\System\\UpdateStatus' => __DIR__ . '/../..' . '/kirby/src/Cms/System/UpdateStatus.php',
        'Kirby\\Cms\\Template' => __DIR__ . '/../..' . '/kirby/src/Cms/Template.php',
        'Kirby\\Cms\\Translation' => __DIR__ . '/../..' . '/kirby/src/Cms/Translation.php',
        'Kirby\\Cms\\Translations' => __DIR__ . '/../..' . '/kirby/src/Cms/Translations.php',
        'Kirby\\Cms\\Url' => __DIR__ . '/../..' . '/kirby/src/Cms/Url.php',
        'Kirby\\Cms\\User' => __DIR__ . '/../..' . '/kirby/src/Cms/User.php',
        'Kirby\\Cms\\UserActions' => __DIR__ . '/../..' . '/kirby/src/Cms/UserActions.php',
        'Kirby\\Cms\\UserBlueprint' => __DIR__ . '/../..' . '/kirby/src/Cms/UserBlueprint.php',
        'Kirby\\Cms\\UserPermissions' => __DIR__ . '/../..' . '/kirby/src/Cms/UserPermissions.php',
        'Kirby\\Cms\\UserPicker' => __DIR__ . '/../..' . '/kirby/src/Cms/UserPicker.php',
        'Kirby\\Cms\\UserRules' => __DIR__ . '/../..' . '/kirby/src/Cms/UserRules.php',
        'Kirby\\Cms\\Users' => __DIR__ . '/../..' . '/kirby/src/Cms/Users.php',
        'Kirby\\Cms\\Visitor' => __DIR__ . '/../..' . '/kirby/src/Cms/Visitor.php',
        'Kirby\\ComposerInstaller\\CmsInstaller' => __DIR__ . '/..' . '/getkirby/composer-installer/src/ComposerInstaller/CmsInstaller.php',
        'Kirby\\ComposerInstaller\\Installer' => __DIR__ . '/..' . '/getkirby/composer-installer/src/ComposerInstaller/Installer.php',
        'Kirby\\ComposerInstaller\\Plugin' => __DIR__ . '/..' . '/getkirby/composer-installer/src/ComposerInstaller/Plugin.php',
        'Kirby\\ComposerInstaller\\PluginInstaller' => __DIR__ . '/..' . '/getkirby/composer-installer/src/ComposerInstaller/PluginInstaller.php',
        'Kirby\\Data\\Data' => __DIR__ . '/../..' . '/kirby/src/Data/Data.php',
        'Kirby\\Data\\Handler' => __DIR__ . '/../..' . '/kirby/src/Data/Handler.php',
        'Kirby\\Data\\Json' => __DIR__ . '/../..' . '/kirby/src/Data/Json.php',
        'Kirby\\Data\\PHP' => __DIR__ . '/../..' . '/kirby/src/Data/PHP.php',
        'Kirby\\Data\\Txt' => __DIR__ . '/../..' . '/kirby/src/Data/Txt.php',
        'Kirby\\Data\\Xml' => __DIR__ . '/../..' . '/kirby/src/Data/Xml.php',
        'Kirby\\Data\\Yaml' => __DIR__ . '/../..' . '/kirby/src/Data/Yaml.php',
        'Kirby\\Database\\Database' => __DIR__ . '/../..' . '/kirby/src/Database/Database.php',
        'Kirby\\Database\\Db' => __DIR__ . '/../..' . '/kirby/src/Database/Db.php',
        'Kirby\\Database\\Query' => __DIR__ . '/../..' . '/kirby/src/Database/Query.php',
        'Kirby\\Database\\Sql' => __DIR__ . '/../..' . '/kirby/src/Database/Sql.php',
        'Kirby\\Database\\Sql\\Mysql' => __DIR__ . '/../..' . '/kirby/src/Database/Sql/Mysql.php',
        'Kirby\\Database\\Sql\\Sqlite' => __DIR__ . '/../..' . '/kirby/src/Database/Sql/Sqlite.php',
        'Kirby\\Email\\Body' => __DIR__ . '/../..' . '/kirby/src/Email/Body.php',
        'Kirby\\Email\\Email' => __DIR__ . '/../..' . '/kirby/src/Email/Email.php',
        'Kirby\\Email\\PHPMailer' => __DIR__ . '/../..' . '/kirby/src/Email/PHPMailer.php',
        'Kirby\\Exception\\BadMethodCallException' => __DIR__ . '/../..' . '/kirby/src/Exception/BadMethodCallException.php',
        'Kirby\\Exception\\DuplicateException' => __DIR__ . '/../..' . '/kirby/src/Exception/DuplicateException.php',
        'Kirby\\Exception\\ErrorPageException' => __DIR__ . '/../..' . '/kirby/src/Exception/ErrorPageException.php',
        'Kirby\\Exception\\Exception' => __DIR__ . '/../..' . '/kirby/src/Exception/Exception.php',
        'Kirby\\Exception\\InvalidArgumentException' => __DIR__ . '/../..' . '/kirby/src/Exception/InvalidArgumentException.php',
        'Kirby\\Exception\\LogicException' => __DIR__ . '/../..' . '/kirby/src/Exception/LogicException.php',
        'Kirby\\Exception\\NotFoundException' => __DIR__ . '/../..' . '/kirby/src/Exception/NotFoundException.php',
        'Kirby\\Exception\\PermissionException' => __DIR__ . '/../..' . '/kirby/src/Exception/PermissionException.php',
        'Kirby\\Field\\FieldOptions' => __DIR__ . '/../..' . '/kirby/src/Field/FieldOptions.php',
        'Kirby\\Filesystem\\Asset' => __DIR__ . '/../..' . '/kirby/src/Filesystem/Asset.php',
        'Kirby\\Filesystem\\Dir' => __DIR__ . '/../..' . '/kirby/src/Filesystem/Dir.php',
        'Kirby\\Filesystem\\F' => __DIR__ . '/../..' . '/kirby/src/Filesystem/F.php',
        'Kirby\\Filesystem\\File' => __DIR__ . '/../..' . '/kirby/src/Filesystem/File.php',
        'Kirby\\Filesystem\\Filename' => __DIR__ . '/../..' . '/kirby/src/Filesystem/Filename.php',
        'Kirby\\Filesystem\\IsFile' => __DIR__ . '/../..' . '/kirby/src/Filesystem/IsFile.php',
        'Kirby\\Filesystem\\Mime' => __DIR__ . '/../..' . '/kirby/src/Filesystem/Mime.php',
        'Kirby\\Form\\Field' => __DIR__ . '/../..' . '/kirby/src/Form/Field.php',
        'Kirby\\Form\\FieldClass' => __DIR__ . '/../..' . '/kirby/src/Form/FieldClass.php',
        'Kirby\\Form\\Field\\BlocksField' => __DIR__ . '/../..' . '/kirby/src/Form/Field/BlocksField.php',
        'Kirby\\Form\\Field\\LayoutField' => __DIR__ . '/../..' . '/kirby/src/Form/Field/LayoutField.php',
        'Kirby\\Form\\Fields' => __DIR__ . '/../..' . '/kirby/src/Form/Fields.php',
        'Kirby\\Form\\Form' => __DIR__ . '/../..' . '/kirby/src/Form/Form.php',
        'Kirby\\Form\\Mixin\\EmptyState' => __DIR__ . '/../..' . '/kirby/src/Form/Mixin/EmptyState.php',
        'Kirby\\Form\\Mixin\\Max' => __DIR__ . '/../..' . '/kirby/src/Form/Mixin/Max.php',
        'Kirby\\Form\\Mixin\\Min' => __DIR__ . '/../..' . '/kirby/src/Form/Mixin/Min.php',
        'Kirby\\Form\\Options' => __DIR__ . '/../..' . '/kirby/src/Form/Options.php',
        'Kirby\\Form\\OptionsApi' => __DIR__ . '/../..' . '/kirby/src/Form/OptionsApi.php',
        'Kirby\\Form\\OptionsQuery' => __DIR__ . '/../..' . '/kirby/src/Form/OptionsQuery.php',
        'Kirby\\Form\\Validations' => __DIR__ . '/../..' . '/kirby/src/Form/Validations.php',
        'Kirby\\Http\\Cookie' => __DIR__ . '/../..' . '/kirby/src/Http/Cookie.php',
        'Kirby\\Http\\Environment' => __DIR__ . '/../..' . '/kirby/src/Http/Environment.php',
        'Kirby\\Http\\Exceptions\\NextRouteException' => __DIR__ . '/../..' . '/kirby/src/Http/Exceptions/NextRouteException.php',
        'Kirby\\Http\\Header' => __DIR__ . '/../..' . '/kirby/src/Http/Header.php',
        'Kirby\\Http\\Idn' => __DIR__ . '/../..' . '/kirby/src/Http/Idn.php',
        'Kirby\\Http\\Params' => __DIR__ . '/../..' . '/kirby/src/Http/Params.php',
        'Kirby\\Http\\Path' => __DIR__ . '/../..' . '/kirby/src/Http/Path.php',
        'Kirby\\Http\\Query' => __DIR__ . '/../..' . '/kirby/src/Http/Query.php',
        'Kirby\\Http\\Remote' => __DIR__ . '/../..' . '/kirby/src/Http/Remote.php',
        'Kirby\\Http\\Request' => __DIR__ . '/../..' . '/kirby/src/Http/Request.php',
        'Kirby\\Http\\Request\\Auth' => __DIR__ . '/../..' . '/kirby/src/Http/Request/Auth.php',
        'Kirby\\Http\\Request\\Auth\\BasicAuth' => __DIR__ . '/../..' . '/kirby/src/Http/Request/Auth/BasicAuth.php',
        'Kirby\\Http\\Request\\Auth\\BearerAuth' => __DIR__ . '/../..' . '/kirby/src/Http/Request/Auth/BearerAuth.php',
        'Kirby\\Http\\Request\\Auth\\SessionAuth' => __DIR__ . '/../..' . '/kirby/src/Http/Request/Auth/SessionAuth.php',
        'Kirby\\Http\\Request\\Body' => __DIR__ . '/../..' . '/kirby/src/Http/Request/Body.php',
        'Kirby\\Http\\Request\\Data' => __DIR__ . '/../..' . '/kirby/src/Http/Request/Data.php',
        'Kirby\\Http\\Request\\Files' => __DIR__ . '/../..' . '/kirby/src/Http/Request/Files.php',
        'Kirby\\Http\\Request\\Query' => __DIR__ . '/../..' . '/kirby/src/Http/Request/Query.php',
        'Kirby\\Http\\Response' => __DIR__ . '/../..' . '/kirby/src/Http/Response.php',
        'Kirby\\Http\\Route' => __DIR__ . '/../..' . '/kirby/src/Http/Route.php',
        'Kirby\\Http\\Router' => __DIR__ . '/../..' . '/kirby/src/Http/Router.php',
        'Kirby\\Http\\Uri' => __DIR__ . '/../..' . '/kirby/src/Http/Uri.php',
        'Kirby\\Http\\Url' => __DIR__ . '/../..' . '/kirby/src/Http/Url.php',
        'Kirby\\Http\\Visitor' => __DIR__ . '/../..' . '/kirby/src/Http/Visitor.php',
        'Kirby\\Image\\Camera' => __DIR__ . '/../..' . '/kirby/src/Image/Camera.php',
        'Kirby\\Image\\Darkroom' => __DIR__ . '/../..' . '/kirby/src/Image/Darkroom.php',
        'Kirby\\Image\\Darkroom\\GdLib' => __DIR__ . '/../..' . '/kirby/src/Image/Darkroom/GdLib.php',
        'Kirby\\Image\\Darkroom\\ImageMagick' => __DIR__ . '/../..' . '/kirby/src/Image/Darkroom/ImageMagick.php',
        'Kirby\\Image\\Dimensions' => __DIR__ . '/../..' . '/kirby/src/Image/Dimensions.php',
        'Kirby\\Image\\Exif' => __DIR__ . '/../..' . '/kirby/src/Image/Exif.php',
        'Kirby\\Image\\Image' => __DIR__ . '/../..' . '/kirby/src/Image/Image.php',
        'Kirby\\Image\\Location' => __DIR__ . '/../..' . '/kirby/src/Image/Location.php',
        'Kirby\\Option\\Option' => __DIR__ . '/../..' . '/kirby/src/Option/Option.php',
        'Kirby\\Option\\Options' => __DIR__ . '/../..' . '/kirby/src/Option/Options.php',
        'Kirby\\Option\\OptionsApi' => __DIR__ . '/../..' . '/kirby/src/Option/OptionsApi.php',
        'Kirby\\Option\\OptionsProvider' => __DIR__ . '/../..' . '/kirby/src/Option/OptionsProvider.php',
        'Kirby\\Option\\OptionsQuery' => __DIR__ . '/../..' . '/kirby/src/Option/OptionsQuery.php',
        'Kirby\\Panel\\Dialog' => __DIR__ . '/../..' . '/kirby/src/Panel/Dialog.php',
        'Kirby\\Panel\\Document' => __DIR__ . '/../..' . '/kirby/src/Panel/Document.php',
        'Kirby\\Panel\\Dropdown' => __DIR__ . '/../..' . '/kirby/src/Panel/Dropdown.php',
        'Kirby\\Panel\\Field' => __DIR__ . '/../..' . '/kirby/src/Panel/Field.php',
        'Kirby\\Panel\\File' => __DIR__ . '/../..' . '/kirby/src/Panel/File.php',
        'Kirby\\Panel\\Home' => __DIR__ . '/../..' . '/kirby/src/Panel/Home.php',
        'Kirby\\Panel\\Json' => __DIR__ . '/../..' . '/kirby/src/Panel/Json.php',
        'Kirby\\Panel\\Model' => __DIR__ . '/../..' . '/kirby/src/Panel/Model.php',
        'Kirby\\Panel\\Page' => __DIR__ . '/../..' . '/kirby/src/Panel/Page.php',
        'Kirby\\Panel\\Panel' => __DIR__ . '/../..' . '/kirby/src/Panel/Panel.php',
        'Kirby\\Panel\\Plugins' => __DIR__ . '/../..' . '/kirby/src/Panel/Plugins.php',
        'Kirby\\Panel\\Redirect' => __DIR__ . '/../..' . '/kirby/src/Panel/Redirect.php',
        'Kirby\\Panel\\Search' => __DIR__ . '/../..' . '/kirby/src/Panel/Search.php',
        'Kirby\\Panel\\Site' => __DIR__ . '/../..' . '/kirby/src/Panel/Site.php',
        'Kirby\\Panel\\User' => __DIR__ . '/../..' . '/kirby/src/Panel/User.php',
        'Kirby\\Panel\\View' => __DIR__ . '/../..' . '/kirby/src/Panel/View.php',
        'Kirby\\Parsley\\Element' => __DIR__ . '/../..' . '/kirby/src/Parsley/Element.php',
        'Kirby\\Parsley\\Inline' => __DIR__ . '/../..' . '/kirby/src/Parsley/Inline.php',
        'Kirby\\Parsley\\Parsley' => __DIR__ . '/../..' . '/kirby/src/Parsley/Parsley.php',
        'Kirby\\Parsley\\Schema' => __DIR__ . '/../..' . '/kirby/src/Parsley/Schema.php',
        'Kirby\\Parsley\\Schema\\Blocks' => __DIR__ . '/../..' . '/kirby/src/Parsley/Schema/Blocks.php',
        'Kirby\\Parsley\\Schema\\Plain' => __DIR__ . '/../..' . '/kirby/src/Parsley/Schema/Plain.php',
        'Kirby\\Sane\\DomHandler' => __DIR__ . '/../..' . '/kirby/src/Sane/DomHandler.php',
        'Kirby\\Sane\\Handler' => __DIR__ . '/../..' . '/kirby/src/Sane/Handler.php',
        'Kirby\\Sane\\Html' => __DIR__ . '/../..' . '/kirby/src/Sane/Html.php',
        'Kirby\\Sane\\Sane' => __DIR__ . '/../..' . '/kirby/src/Sane/Sane.php',
        'Kirby\\Sane\\Svg' => __DIR__ . '/../..' . '/kirby/src/Sane/Svg.php',
        'Kirby\\Sane\\Svgz' => __DIR__ . '/../..' . '/kirby/src/Sane/Svgz.php',
        'Kirby\\Sane\\Xml' => __DIR__ . '/../..' . '/kirby/src/Sane/Xml.php',
        'Kirby\\Session\\AutoSession' => __DIR__ . '/../..' . '/kirby/src/Session/AutoSession.php',
        'Kirby\\Session\\FileSessionStore' => __DIR__ . '/../..' . '/kirby/src/Session/FileSessionStore.php',
        'Kirby\\Session\\Session' => __DIR__ . '/../..' . '/kirby/src/Session/Session.php',
        'Kirby\\Session\\SessionData' => __DIR__ . '/../..' . '/kirby/src/Session/SessionData.php',
        'Kirby\\Session\\SessionStore' => __DIR__ . '/../..' . '/kirby/src/Session/SessionStore.php',
        'Kirby\\Session\\Sessions' => __DIR__ . '/../..' . '/kirby/src/Session/Sessions.php',
        'Kirby\\Text\\KirbyTag' => __DIR__ . '/../..' . '/kirby/src/Text/KirbyTag.php',
        'Kirby\\Text\\KirbyTags' => __DIR__ . '/../..' . '/kirby/src/Text/KirbyTags.php',
        'Kirby\\Text\\Markdown' => __DIR__ . '/../..' . '/kirby/src/Text/Markdown.php',
        'Kirby\\Text\\SmartyPants' => __DIR__ . '/../..' . '/kirby/src/Text/SmartyPants.php',
        'Kirby\\Toolkit\\A' => __DIR__ . '/../..' . '/kirby/src/Toolkit/A.php',
        'Kirby\\Toolkit\\Collection' => __DIR__ . '/../..' . '/kirby/src/Toolkit/Collection.php',
        'Kirby\\Toolkit\\Component' => __DIR__ . '/../..' . '/kirby/src/Toolkit/Component.php',
        'Kirby\\Toolkit\\Config' => __DIR__ . '/../..' . '/kirby/src/Toolkit/Config.php',
        'Kirby\\Toolkit\\Controller' => __DIR__ . '/../..' . '/kirby/src/Toolkit/Controller.php',
        'Kirby\\Toolkit\\Date' => __DIR__ . '/../..' . '/kirby/src/Toolkit/Date.php',
        'Kirby\\Toolkit\\Dom' => __DIR__ . '/../..' . '/kirby/src/Toolkit/Dom.php',
        'Kirby\\Toolkit\\Escape' => __DIR__ . '/../..' . '/kirby/src/Toolkit/Escape.php',
        'Kirby\\Toolkit\\Facade' => __DIR__ . '/../..' . '/kirby/src/Toolkit/Facade.php',
        'Kirby\\Toolkit\\Html' => __DIR__ . '/../..' . '/kirby/src/Toolkit/Html.php',
        'Kirby\\Toolkit\\I18n' => __DIR__ . '/../..' . '/kirby/src/Toolkit/I18n.php',
        'Kirby\\Toolkit\\Iterator' => __DIR__ . '/../..' . '/kirby/src/Toolkit/Iterator.php',
        'Kirby\\Toolkit\\Locale' => __DIR__ . '/../..' . '/kirby/src/Toolkit/Locale.php',
        'Kirby\\Toolkit\\Obj' => __DIR__ . '/../..' . '/kirby/src/Toolkit/Obj.php',
        'Kirby\\Toolkit\\Pagination' => __DIR__ . '/../..' . '/kirby/src/Toolkit/Pagination.php',
        'Kirby\\Toolkit\\Properties' => __DIR__ . '/../..' . '/kirby/src/Toolkit/Properties.php',
        'Kirby\\Toolkit\\Query' => __DIR__ . '/../..' . '/kirby/src/Toolkit/Query.php',
        'Kirby\\Toolkit\\Silo' => __DIR__ . '/../..' . '/kirby/src/Toolkit/Silo.php',
        'Kirby\\Toolkit\\Str' => __DIR__ . '/../..' . '/kirby/src/Toolkit/Str.php',
        'Kirby\\Toolkit\\Tpl' => __DIR__ . '/../..' . '/kirby/src/Toolkit/Tpl.php',
        'Kirby\\Toolkit\\V' => __DIR__ . '/../..' . '/kirby/src/Toolkit/V.php',
        'Kirby\\Toolkit\\View' => __DIR__ . '/../..' . '/kirby/src/Toolkit/View.php',
        'Kirby\\Toolkit\\Xml' => __DIR__ . '/../..' . '/kirby/src/Toolkit/Xml.php',
        'Kirby\\Uuid\\BlockUuid' => __DIR__ . '/../..' . '/kirby/src/Uuid/BlockUuid.php',
        'Kirby\\Uuid\\FieldUuid' => __DIR__ . '/../..' . '/kirby/src/Uuid/FieldUuid.php',
        'Kirby\\Uuid\\FileUuid' => __DIR__ . '/../..' . '/kirby/src/Uuid/FileUuid.php',
        'Kirby\\Uuid\\HasUuids' => __DIR__ . '/../..' . '/kirby/src/Uuid/HasUuids.php',
        'Kirby\\Uuid\\Identifiable' => __DIR__ . '/../..' . '/kirby/src/Uuid/Identifiable.php',
        'Kirby\\Uuid\\ModelUuid' => __DIR__ . '/../..' . '/kirby/src/Uuid/ModelUuid.php',
        'Kirby\\Uuid\\PageUuid' => __DIR__ . '/../..' . '/kirby/src/Uuid/PageUuid.php',
        'Kirby\\Uuid\\SiteUuid' => __DIR__ . '/../..' . '/kirby/src/Uuid/SiteUuid.php',
        'Kirby\\Uuid\\StructureUuid' => __DIR__ . '/../..' . '/kirby/src/Uuid/StructureUuid.php',
        'Kirby\\Uuid\\Uri' => __DIR__ . '/../..' . '/kirby/src/Uuid/Uri.php',
        'Kirby\\Uuid\\UserUuid' => __DIR__ . '/../..' . '/kirby/src/Uuid/UserUuid.php',
        'Kirby\\Uuid\\Uuid' => __DIR__ . '/../..' . '/kirby/src/Uuid/Uuid.php',
        'Kirby\\Uuid\\Uuids' => __DIR__ . '/../..' . '/kirby/src/Uuid/Uuids.php',
        'Laminas\\Escaper\\Escaper' => __DIR__ . '/..' . '/laminas/laminas-escaper/src/Escaper.php',
        'Laminas\\Escaper\\Exception\\ExceptionInterface' => __DIR__ . '/..' . '/laminas/laminas-escaper/src/Exception/ExceptionInterface.php',
        'Laminas\\Escaper\\Exception\\InvalidArgumentException' => __DIR__ . '/..' . '/laminas/laminas-escaper/src/Exception/InvalidArgumentException.php',
        'Laminas\\Escaper\\Exception\\RuntimeException' => __DIR__ . '/..' . '/laminas/laminas-escaper/src/Exception/RuntimeException.php',
        'League\\ColorExtractor\\Color' => __DIR__ . '/..' . '/league/color-extractor/src/League/ColorExtractor/Color.php',
        'League\\ColorExtractor\\ColorExtractor' => __DIR__ . '/..' . '/league/color-extractor/src/League/ColorExtractor/ColorExtractor.php',
        'League\\ColorExtractor\\Palette' => __DIR__ . '/..' . '/league/color-extractor/src/League/ColorExtractor/Palette.php',
        'Michelf\\SmartyPants' => __DIR__ . '/..' . '/michelf/php-smartypants/Michelf/SmartyPants.php',
        'Michelf\\SmartyPantsTypographer' => __DIR__ . '/..' . '/michelf/php-smartypants/Michelf/SmartyPantsTypographer.php',
        'Normalizer' => __DIR__ . '/..' . '/symfony/polyfill-intl-normalizer/Resources/stubs/Normalizer.php',
        'PHPMailer\\PHPMailer\\Exception' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/Exception.php',
        'PHPMailer\\PHPMailer\\OAuth' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/OAuth.php',
        'PHPMailer\\PHPMailer\\OAuthTokenProvider' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/OAuthTokenProvider.php',
        'PHPMailer\\PHPMailer\\PHPMailer' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/PHPMailer.php',
        'PHPMailer\\PHPMailer\\POP3' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/POP3.php',
        'PHPMailer\\PHPMailer\\SMTP' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/SMTP.php',
        'Parsedown' => __DIR__ . '/../..' . '/kirby/dependencies/parsedown/Parsedown.php',
        'ParsedownExtra' => __DIR__ . '/../..' . '/kirby/dependencies/parsedown-extra/ParsedownExtra.php',
        'Psr\\Log\\AbstractLogger' => __DIR__ . '/..' . '/psr/log/src/AbstractLogger.php',
        'Psr\\Log\\InvalidArgumentException' => __DIR__ . '/..' . '/psr/log/src/InvalidArgumentException.php',
        'Psr\\Log\\LogLevel' => __DIR__ . '/..' . '/psr/log/src/LogLevel.php',
        'Psr\\Log\\LoggerAwareInterface' => __DIR__ . '/..' . '/psr/log/src/LoggerAwareInterface.php',
        'Psr\\Log\\LoggerAwareTrait' => __DIR__ . '/..' . '/psr/log/src/LoggerAwareTrait.php',
        'Psr\\Log\\LoggerInterface' => __DIR__ . '/..' . '/psr/log/src/LoggerInterface.php',
        'Psr\\Log\\LoggerTrait' => __DIR__ . '/..' . '/psr/log/src/LoggerTrait.php',
        'Psr\\Log\\NullLogger' => __DIR__ . '/..' . '/psr/log/src/NullLogger.php',
        'Spyc' => __DIR__ . '/../..' . '/kirby/dependencies/spyc/Spyc.php',
        'Symfony\\Polyfill\\Intl\\Idn\\Idn' => __DIR__ . '/..' . '/symfony/polyfill-intl-idn/Idn.php',
        'Symfony\\Polyfill\\Intl\\Idn\\Info' => __DIR__ . '/..' . '/symfony/polyfill-intl-idn/Info.php',
        'Symfony\\Polyfill\\Intl\\Idn\\Resources\\unidata\\DisallowedRanges' => __DIR__ . '/..' . '/symfony/polyfill-intl-idn/Resources/unidata/DisallowedRanges.php',
        'Symfony\\Polyfill\\Intl\\Idn\\Resources\\unidata\\Regex' => __DIR__ . '/..' . '/symfony/polyfill-intl-idn/Resources/unidata/Regex.php',
        'Symfony\\Polyfill\\Intl\\Normalizer\\Normalizer' => __DIR__ . '/..' . '/symfony/polyfill-intl-normalizer/Normalizer.php',
        'Symfony\\Polyfill\\Mbstring\\Mbstring' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/Mbstring.php',
        'Whoops\\Exception\\ErrorException' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Exception/ErrorException.php',
        'Whoops\\Exception\\Formatter' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Exception/Formatter.php',
        'Whoops\\Exception\\Frame' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Exception/Frame.php',
        'Whoops\\Exception\\FrameCollection' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Exception/FrameCollection.php',
        'Whoops\\Exception\\Inspector' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Exception/Inspector.php',
        'Whoops\\Handler\\CallbackHandler' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Handler/CallbackHandler.php',
        'Whoops\\Handler\\Handler' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Handler/Handler.php',
        'Whoops\\Handler\\HandlerInterface' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Handler/HandlerInterface.php',
        'Whoops\\Handler\\JsonResponseHandler' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Handler/JsonResponseHandler.php',
        'Whoops\\Handler\\PlainTextHandler' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Handler/PlainTextHandler.php',
        'Whoops\\Handler\\PrettyPageHandler' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Handler/PrettyPageHandler.php',
        'Whoops\\Handler\\XmlResponseHandler' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Handler/XmlResponseHandler.php',
        'Whoops\\Run' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Run.php',
        'Whoops\\RunInterface' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/RunInterface.php',
        'Whoops\\Util\\HtmlDumperOutput' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Util/HtmlDumperOutput.php',
        'Whoops\\Util\\Misc' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Util/Misc.php',
        'Whoops\\Util\\SystemFacade' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Util/SystemFacade.php',
        'Whoops\\Util\\TemplateHelper' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Util/TemplateHelper.php',
        'claviska\\SimpleImage' => __DIR__ . '/..' . '/claviska/simpleimage/src/claviska/SimpleImage.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit949b6354a133bbf3c81dd503bfd714ad::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit949b6354a133bbf3c81dd503bfd714ad::$prefixDirsPsr4;
            $loader->fallbackDirsPsr4 = ComposerStaticInit949b6354a133bbf3c81dd503bfd714ad::$fallbackDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit949b6354a133bbf3c81dd503bfd714ad::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit949b6354a133bbf3c81dd503bfd714ad::$classMap;

        }, null, ClassLoader::class);
    }
}
