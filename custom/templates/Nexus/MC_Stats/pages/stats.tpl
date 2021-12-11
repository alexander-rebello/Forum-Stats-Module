{include file='header.tpl'}
{include file='navbar.tpl'}

<div class="ui stackable grid" style="margin-top: 20px;">
  <div class="ui centered row">
  	{if count($WIDGETS_LEFT)}
        <div class="ui six wide tablet four wide computer column">
            {foreach from=$WIDGETS_LEFT item=widget}
                {$widget}
            {/foreach}
        </div>
    {/if}
    <div class="ui {if count($WIDGETS_LEFT) && count($WIDGETS_RIGHT) }four wide tablet eight wide computer{elseif count($WIDGETS_LEFT) || count($WIDGETS_RIGHT)}ten wide tablet twelve wide computer{else}sixteen wide{/if} column">
      <div class="ui fluid card">
        <div class="content">
          <div class="ui dividing header">
            {$TITLE}
          </div>
          <div class="description">
            <div class="ui stackable grid">
              <div class="ui row" style="padding-bottom: 0;">
                <div class="ui four wide tablet six wide computer column">
                    <img class="ui circular image" src="{$IMAGE}">
                </div>
                <div class="ui four wide tablet ten wide computer column">
                  <table class="ui celled table">
                    <tbody>
                      <tr>
                        <td data-label="{$MONEY_CITYBUILD_TITLE}"><h3>{$MONEY_CITYBUILD_TITLE}</h3></td>
                        <td data-label="{$MONEY_CITYBUILD_TITLE}"><h3><strong>{$MONEY_CITYBUILD_VALUE}</strong></h3></td>
                      </tr>
                      <tr>
                        <td data-label="{$MONEY_FREEBUILD_TITLE}"><h3>{$MONEY_FREEBUILD_TITLE}</h3></td>
                        <td data-label="{$MONEY_FREEBUILD_TITLE}"><h3><strong>{$MONEY_FREEBUILD_VALUE}</strong></h3></td>
                      </tr>
                      <tr>
                        <td data-label="{$MONEY_SKYBLOCK_TITLE}"><h3>{$MONEY_SKYBLOCK_TITLE}</h3></td>
                        <td data-label="{$MONEY_SKYBLOCK_TITLE}"><h3><strong>{$MONEY_SKYBLOCK_VALUE}</strong></h3></td>
                      </tr>
                      <tr>
                        <td data-label="{$TERRA_TITLE}"><h3>{$TERRA_TITLE}</h3></td>
                        <td data-label="{$TERRA_TITLE}"><h3><strong>{$TERRA_VALUE}</strong></h3></td>
                      </tr>
                      <tr>
                        <td data-label="{$PLAYTIME_TITLE}"><h3>{$PLAYTIME_TITLE}</h3></td>
                        <td data-label="{$PLAYTIME_TITLE}"><h3><strong>{$PLAYTIME_VALUE}</strong></h3></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {if count($WIDGETS_RIGHT)}
      <div class="ui six wide tablet four wide computer column">
        {foreach from=$WIDGETS_RIGHT item=widget}
          {$widget}
        {/foreach}
      </div>
    {/if}
  </div>
</div>

{include file='footer.tpl'}