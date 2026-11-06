{* Modules Developer - Admin template *}

{$config_form}

{if $author_name}
    <div class="alert alert-info">
        <strong>{l s='Showing modules from:' mod='modules_developer'}</strong> {$author_name|escape:'html':'UTF-8'}
    </div>

    {if $modules|@count > 0}
        <div class="row" style="margin-top:20px;display:flex;flex-wrap:wrap;">
            {foreach from=$modules item=mod}
                <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom:20px;display:flex;">
                    <div class="panel" style="width:100%;display:flex;flex-direction:column;border:1px solid #ddd;border-radius:4px;transition:box-shadow .2s;">
                        <div class="panel-heading" style="background:#f8f9fa;border-bottom:1px solid #dee2e6;padding:.75rem 1.25rem;">
                            <strong>{$mod.displayName|escape:'html':'UTF-8'}</strong>
                        </div>
                        <div class="panel-body" style="padding:.75rem 1.25rem;flex:1;">
                            <p><strong>{l s='Version:' mod='modules_developer'}</strong> {$mod.version|escape:'html':'UTF-8'}</p>
                            <p><strong>{l s='Author:' mod='modules_developer'}</strong> {$mod.author|escape:'html':'UTF-8'}</p>
                            <p><strong>{l s='Technical name:' mod='modules_developer'}</strong> <code>{$mod.name|escape:'html':'UTF-8'}</code></p>
                            {if $mod.description}
                                <p><strong>{l s='Description:' mod='modules_developer'}</strong> {$mod.description|escape:'html':'UTF-8'}</p>
                            {/if}
                            <p>
                                <strong>{l s='Status:' mod='modules_developer'}</strong>
                                {if $mod.is_installed}
                                    <span class="label label-success">{l s='Installed' mod='modules_developer'}</span>
                                {else}
                                    <span class="label label-default">{l s='Not installed' mod='modules_developer'}</span>
                                {/if}
                            </p>
                        </div>
                    </div>
                </div>
            {/foreach}
        </div>
    {else}
        <div class="alert alert-warning">
            {l s='No modules found for author' mod='modules_developer'} "<strong>{$author_name|escape:'html':'UTF-8'}</strong>"
        </div>
    {/if}
{else}
    <div class="alert alert-warning">
        {l s='Enter an author name above to list their modules.' mod='modules_developer'}
    </div>
{/if}
