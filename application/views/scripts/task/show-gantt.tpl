<div class="page">
    <h1 style="width: 300px;">Проекты. Диаграмма Ганта</h1>

    <div class="page_block">
        {if_allowed resource="{$controller}/index" priv="show"}
            <a href="{$this->url(['controller' => $controller, 'action' => 'index'])}">Проекты</a>
        {/if_allowed}
    </div>

</div><br/>

<script type="text/javascript">
    function createChartControl(htmlDiv1) {

        var projectArray = new Array();
        var i = 0;

        {foreach from=$taskList item=task}
        var project = new GanttProjectInfo({$task->id}, "{$task->title}", new Date({$task->dateCreate|date_format:"%Y"}, {$task->dateCreate|date_format:"%m"}, {$task->dateCreate|date_format:"%d"}));
        projectArray.push(project);
        {if $task->getChild()}
        {foreach from=$task->getChild() item=fChild}

        var parentTask = new GanttTaskInfo({$fChild->id}, "{$fChild->title}", new Date({$fChild->dateCreate|date_format:"%Y"}, {$fChild->dateCreate|date_format:"%m"}, {$fChild->dateCreate|date_format:"%d"}), {$fChild->getEstHours()}, 50, "");

        {if $fChild->getChild()}
        {include file="task/gantt-block.tpl" subtask=$fChild->getChild()}
        {/if}

        project.addTask(parentTask);
        {/foreach}
        {/if}
        {/foreach}

        // Create Gantt control
        var ganttChartControl = new GanttChart();
        // Setup paths and behavior
        ganttChartControl.setImagePath("/js/gantt/imgs/");
        ganttChartControl.setEditable(false);
        ganttChartControl.showTreePanel(true);
        ganttChartControl.showContextMenu(false);
        ganttChartControl.showDescTask(true, 'n,s-f');
        ganttChartControl.showDescProject(true, 'n,d');

        for (i = 0; i < projectArray.length; i++) {
            ganttChartControl.addProject(projectArray[i]);
        }

        // Build control on the page
        ganttChartControl.create(htmlDiv1);
    }

    $(document).ready(function () {
        createChartControl('GanttDiv');
    });
</script>


<div style="width:100%; height:610px; position:relative" id="GanttDiv"></div>