<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in your browser (Internet Explorer, Mozilla Firefox, Google Chrome, etc.)
 * this means that PHP is not properly installed on your web server. Please refer to the PHP manual
 * for more details: http://php.net/manual/install.php 
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */

    include_once dirname(__FILE__) . '/components/startup.php';
    include_once dirname(__FILE__) . '/components/application.php';


    include_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';
    include_once dirname(__FILE__) . '/' . 'components/page/page.php';
    include_once dirname(__FILE__) . '/' . 'components/page/detail_page.php';
    include_once dirname(__FILE__) . '/' . 'components/page/nested_form_page.php';
    include_once dirname(__FILE__) . '/' . 'authorization.php';

    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        $result['client_encoding'] = 'utf8';
        GetApplication()->GetUserAuthentication()->applyIdentityToConnectionOptions($result);
        return $result;
    }

    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class boking01Page extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`boking`');
            $this->dataset->addFields(
                array(
                    new IntegerField('boking_id', true, true, true),
                    new StringField('boking_nama'),
                    new StringField('boking_email'),
                    new StringField('boking_no_hp'),
                    new IntegerField('boking_room_id'),
                    new IntegerField('boking_Harga', true),
                    new IntegerField('boking_jumlah_jam'),
                    new TimeField('boking_waktu'),
                    new DateField('boking_tanggal', true),
                    new StringField('boking_ket'),
                    new IntegerField('boking_total', true),
                    new IntegerField('boking_deposit', true),
                    new StringField('boking_Bukti_Dp', true),
                    new DateTimeField('boking_created', true)
                )
            );
            $this->dataset->AddLookupField('boking_room_id', 'room', new IntegerField('Room_Id'), new StringField('Room_Name', false, false, false, false, 'boking_room_id_Room_Name', 'boking_room_id_Room_Name_room'), 'boking_room_id_Room_Name_room');
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function setupCharts()
        {
    
        }
    
        protected function getFiltersColumns()
        {
            return array(
                new FilterColumn($this->dataset, 'boking_id', 'boking_id', 'Booking Id'),
                new FilterColumn($this->dataset, 'boking_nama', 'boking_nama', 'Booking Nama'),
                new FilterColumn($this->dataset, 'boking_email', 'boking_email', 'Booking Email'),
                new FilterColumn($this->dataset, 'boking_no_hp', 'boking_no_hp', 'Booking No Hp'),
                new FilterColumn($this->dataset, 'boking_room_id', 'boking_room_id_Room_Name', 'Booking Room Id'),
                new FilterColumn($this->dataset, 'boking_Harga', 'boking_Harga', 'Booking Harga'),
                new FilterColumn($this->dataset, 'boking_jumlah_jam', 'boking_jumlah_jam', 'Booking Jumlah Jam'),
                new FilterColumn($this->dataset, 'boking_waktu', 'boking_waktu', 'Booking Waktu'),
                new FilterColumn($this->dataset, 'boking_tanggal', 'boking_tanggal', 'Booking Tanggal'),
                new FilterColumn($this->dataset, 'boking_ket', 'boking_ket', 'Booking Ket'),
                new FilterColumn($this->dataset, 'boking_total', 'boking_total', 'Booking Total'),
                new FilterColumn($this->dataset, 'boking_deposit', 'boking_deposit', 'Booking Deposit'),
                new FilterColumn($this->dataset, 'boking_Bukti_Dp', 'boking_Bukti_Dp', 'Booking Bukti Dp'),
                new FilterColumn($this->dataset, 'boking_created', 'boking_created', 'Booking Created')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['boking_id'])
                ->addColumn($columns['boking_nama'])
                ->addColumn($columns['boking_email'])
                ->addColumn($columns['boking_no_hp'])
                ->addColumn($columns['boking_room_id'])
                ->addColumn($columns['boking_Harga'])
                ->addColumn($columns['boking_jumlah_jam'])
                ->addColumn($columns['boking_waktu'])
                ->addColumn($columns['boking_tanggal'])
                ->addColumn($columns['boking_ket'])
                ->addColumn($columns['boking_total'])
                ->addColumn($columns['boking_deposit'])
                ->addColumn($columns['boking_Bukti_Dp'])
                ->addColumn($columns['boking_created']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('boking_room_id')
                ->setOptionsFor('boking_waktu')
                ->setOptionsFor('boking_tanggal')
                ->setOptionsFor('boking_ket')
                ->setOptionsFor('boking_created');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('boking_id_edit');
            
            $filterBuilder->addColumn(
                $columns['boking_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('boking_nama');
            
            $filterBuilder->addColumn(
                $columns['boking_nama'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('boking_email');
            
            $filterBuilder->addColumn(
                $columns['boking_email'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('boking_no_hp_edit');
            $main_editor->SetMaxLength(12);
            
            $filterBuilder->addColumn(
                $columns['boking_no_hp'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('boking_room_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_boking_room_id_Room_Name_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('boking_room_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_boking_room_id_Room_Name_search');
            
            $filterBuilder->addColumn(
                $columns['boking_room_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('boking_harga_edit');
            
            $filterBuilder->addColumn(
                $columns['boking_Harga'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('boking_jumlah_jam_edit');
            
            $filterBuilder->addColumn(
                $columns['boking_jumlah_jam'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TimeEdit('boking_waktu_edit', 'H:i:s');
            
            $filterBuilder->addColumn(
                $columns['boking_waktu'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('boking_tanggal_edit', false, 'd-m-Y');
            
            $filterBuilder->addColumn(
                $columns['boking_tanggal'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('boking_ket_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $main_editor->addChoice('Belum Lunas', 'Belum Lunas');
            $main_editor->addChoice('DP Bukti Kirim', 'DP Bukti Kirim');
            $main_editor->addChoice('DP Lunas', 'DP Lunas');
            $main_editor->addChoice('Lunas', 'Lunas');
            $main_editor->addChoice('Selesai', 'Selesai');
            $main_editor->addChoice('Batal', 'Batal');
            $main_editor->SetAllowNullValue(false);
            
            $multi_value_select_editor = new MultiValueSelect('boking_ket');
            $multi_value_select_editor->setChoices($main_editor->getChoices());
            
            $text_editor = new TextEdit('boking_ket');
            
            $filterBuilder->addColumn(
                $columns['boking_ket'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('boking_total_edit');
            
            $filterBuilder->addColumn(
                $columns['boking_total'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('boking_deposit_edit');
            
            $filterBuilder->addColumn(
                $columns['boking_deposit'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('boking_Bukti_Dp');
            
            $filterBuilder->addColumn(
                $columns['boking_Bukti_Dp'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('boking_created_edit', false, 'd-m-Y H:i:s');
            
            $filterBuilder->addColumn(
                $columns['boking_created'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actions = $grid->getActions();
            $actions->setCaption($this->GetLocalizerCaptions()->GetMessageString('Actions'));
            $actions->setPosition(ActionList::POSITION_LEFT);
            
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $operation = new AjaxOperation(OPERATION_VIEW,
                    $this->GetLocalizerCaptions()->GetMessageString('View'),
                    $this->GetLocalizerCaptions()->GetMessageString('View'), $this->dataset,
                    $this->GetModalGridViewHandler(), $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
            
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $operation = new AjaxOperation(OPERATION_EDIT,
                    $this->GetLocalizerCaptions()->GetMessageString('Edit'),
                    $this->GetLocalizerCaptions()->GetMessageString('Edit'), $this->dataset,
                    $this->GetGridEditHandler(), $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $operation->SetAdditionalAttribute('data-modal-operation', 'delete');
                $operation->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
            
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for boking_id field
            //
            $column = new NumberViewColumn('boking_id', 'boking_id', 'Booking Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for boking_nama field
            //
            $column = new TextViewColumn('boking_nama', 'boking_nama', 'Booking Nama', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('boking01Grid_boking_nama_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for boking_email field
            //
            $column = new TextViewColumn('boking_email', 'boking_email', 'Booking Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('boking01Grid_boking_email_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for boking_no_hp field
            //
            $column = new TextViewColumn('boking_no_hp', 'boking_no_hp', 'Booking No Hp', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Room_Name field
            //
            $column = new TextViewColumn('boking_room_id', 'boking_room_id_Room_Name', 'Booking Room Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for boking_Harga field
            //
            $column = new NumberViewColumn('boking_Harga', 'boking_Harga', 'Booking Harga', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for boking_jumlah_jam field
            //
            $column = new NumberViewColumn('boking_jumlah_jam', 'boking_jumlah_jam', 'Booking Jumlah Jam', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for boking_waktu field
            //
            $column = new DateTimeViewColumn('boking_waktu', 'boking_waktu', 'Booking Waktu', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for boking_tanggal field
            //
            $column = new DateTimeViewColumn('boking_tanggal', 'boking_tanggal', 'Booking Tanggal', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for boking_ket field
            //
            $column = new TextViewColumn('boking_ket', 'boking_ket', 'Booking Ket', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for boking_total field
            //
            $column = new NumberViewColumn('boking_total', 'boking_total', 'Booking Total', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for boking_deposit field
            //
            $column = new NumberViewColumn('boking_deposit', 'boking_deposit', 'Booking Deposit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for boking_Bukti_Dp field
            //
            $column = new DownloadExternalDataColumn('boking_Bukti_Dp', 'boking_Bukti_Dp', 'Booking Bukti Dp', $this->dataset, '');
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for boking_created field
            //
            $column = new DateTimeViewColumn('boking_created', 'boking_created', 'Booking Created', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for boking_id field
            //
            $column = new NumberViewColumn('boking_id', 'boking_id', 'Booking Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for boking_nama field
            //
            $column = new TextViewColumn('boking_nama', 'boking_nama', 'Booking Nama', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('boking01Grid_boking_nama_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for boking_email field
            //
            $column = new TextViewColumn('boking_email', 'boking_email', 'Booking Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('boking01Grid_boking_email_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for boking_no_hp field
            //
            $column = new TextViewColumn('boking_no_hp', 'boking_no_hp', 'Booking No Hp', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Room_Name field
            //
            $column = new TextViewColumn('boking_room_id', 'boking_room_id_Room_Name', 'Booking Room Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for boking_Harga field
            //
            $column = new NumberViewColumn('boking_Harga', 'boking_Harga', 'Booking Harga', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for boking_jumlah_jam field
            //
            $column = new NumberViewColumn('boking_jumlah_jam', 'boking_jumlah_jam', 'Booking Jumlah Jam', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for boking_waktu field
            //
            $column = new DateTimeViewColumn('boking_waktu', 'boking_waktu', 'Booking Waktu', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for boking_tanggal field
            //
            $column = new DateTimeViewColumn('boking_tanggal', 'boking_tanggal', 'Booking Tanggal', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for boking_ket field
            //
            $column = new TextViewColumn('boking_ket', 'boking_ket', 'Booking Ket', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for boking_total field
            //
            $column = new NumberViewColumn('boking_total', 'boking_total', 'Booking Total', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for boking_deposit field
            //
            $column = new NumberViewColumn('boking_deposit', 'boking_deposit', 'Booking Deposit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for boking_Bukti_Dp field
            //
            $column = new DownloadExternalDataColumn('boking_Bukti_Dp', 'boking_Bukti_Dp', 'Booking Bukti Dp', $this->dataset, '');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for boking_created field
            //
            $column = new DateTimeViewColumn('boking_created', 'boking_created', 'Booking Created', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for boking_nama field
            //
            $editor = new TextAreaEdit('boking_nama_edit', 50, 8);
            $editColumn = new CustomEditColumn('Booking Nama', 'boking_nama', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for boking_email field
            //
            $editor = new TextAreaEdit('boking_email_edit', 50, 8);
            $editColumn = new CustomEditColumn('Booking Email', 'boking_email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for boking_no_hp field
            //
            $editor = new TextEdit('boking_no_hp_edit');
            $editor->SetMaxLength(12);
            $editColumn = new CustomEditColumn('Booking No Hp', 'boking_no_hp', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for boking_waktu field
            //
            $editor = new TimeEdit('boking_waktu_edit', 'H:i:s');
            $editColumn = new CustomEditColumn('Booking Waktu', 'boking_waktu', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for boking_tanggal field
            //
            $editor = new DateTimeEdit('boking_tanggal_edit', false, 'd-m-Y');
            $editColumn = new CustomEditColumn('Booking Tanggal', 'boking_tanggal', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for boking_ket field
            //
            $editor = new ComboBox('boking_ket_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Belum Lunas', 'Belum Lunas');
            $editor->addChoice('DP Bukti Kirim', 'DP Bukti Kirim');
            $editor->addChoice('DP Lunas', 'DP Lunas');
            $editor->addChoice('Lunas', 'Lunas');
            $editor->addChoice('Selesai', 'Selesai');
            $editor->addChoice('Batal', 'Batal');
            $editColumn = new CustomEditColumn('Booking Ket', 'boking_ket', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for boking_Bukti_Dp field
            //
            $editor = new ImageUploader('boking_bukti_dp_edit');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Booking Bukti Dp', 'boking_Bukti_Dp', $editor, $this->dataset, false, false, 'BokingBukti', '%random%.%original_file_extension%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for boking_created field
            //
            $editor = new DateTimeEdit('boking_created_edit', false, 'd-m-Y H:i:s');
            $editColumn = new CustomEditColumn('Booking Created', 'boking_created', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for boking_nama field
            //
            $editor = new TextAreaEdit('boking_nama_edit', 50, 8);
            $editColumn = new CustomEditColumn('Booking Nama', 'boking_nama', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for boking_email field
            //
            $editor = new TextAreaEdit('boking_email_edit', 50, 8);
            $editColumn = new CustomEditColumn('Booking Email', 'boking_email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for boking_no_hp field
            //
            $editor = new TextEdit('boking_no_hp_edit');
            $editor->SetMaxLength(12);
            $editColumn = new CustomEditColumn('Booking No Hp', 'boking_no_hp', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for boking_room_id field
            //
            $editor = new DynamicCombobox('boking_room_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`room`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Room_Id', true, true, true),
                    new StringField('Room_Name'),
                    new StringField('Room_Desc'),
                    new StringField('Room_Img'),
                    new IntegerField('Room_Capasitas'),
                    new StringField('Room_Class', true),
                    new IntegerField('Room_Price'),
                    new IntegerField('Room_SpecialPrice'),
                    new IntegerField('Room_Business_Price', true)
                )
            );
            $lookupDataset->setOrderByField('Room_Name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Booking Room Id', 'boking_room_id', 'boking_room_id_Room_Name', 'multi_edit_boking_room_id_Room_Name_search', $editor, $this->dataset, $lookupDataset, 'Room_Id', 'Room_Name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for boking_Harga field
            //
            $editor = new TextEdit('boking_harga_edit');
            $editColumn = new CustomEditColumn('Booking Harga', 'boking_Harga', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for boking_jumlah_jam field
            //
            $editor = new TextEdit('boking_jumlah_jam_edit');
            $editColumn = new CustomEditColumn('Booking Jumlah Jam', 'boking_jumlah_jam', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for boking_waktu field
            //
            $editor = new TimeEdit('boking_waktu_edit', 'H:i:s');
            $editColumn = new CustomEditColumn('Booking Waktu', 'boking_waktu', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for boking_tanggal field
            //
            $editor = new DateTimeEdit('boking_tanggal_edit', false, 'd-m-Y');
            $editColumn = new CustomEditColumn('Booking Tanggal', 'boking_tanggal', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for boking_ket field
            //
            $editor = new ComboBox('boking_ket_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Belum Lunas', 'Belum Lunas');
            $editor->addChoice('DP Bukti Kirim', 'DP Bukti Kirim');
            $editor->addChoice('DP Lunas', 'DP Lunas');
            $editor->addChoice('Lunas', 'Lunas');
            $editor->addChoice('Selesai', 'Selesai');
            $editor->addChoice('Batal', 'Batal');
            $editColumn = new CustomEditColumn('Booking Ket', 'boking_ket', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for boking_total field
            //
            $editor = new TextEdit('boking_total_edit');
            $editColumn = new CustomEditColumn('Booking Total', 'boking_total', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for boking_deposit field
            //
            $editor = new TextEdit('boking_deposit_edit');
            $editColumn = new CustomEditColumn('Booking Deposit', 'boking_deposit', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for boking_Bukti_Dp field
            //
            $editor = new ImageUploader('boking_bukti_dp_edit');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Booking Bukti Dp', 'boking_Bukti_Dp', $editor, $this->dataset, false, false, 'BokingBukti', '%random%.%original_file_extension%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for boking_created field
            //
            $editor = new DateTimeEdit('boking_created_edit', false, 'd-m-Y H:i:s');
            $editColumn = new CustomEditColumn('Booking Created', 'boking_created', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for boking_nama field
            //
            $editor = new TextAreaEdit('boking_nama_edit', 50, 8);
            $editColumn = new CustomEditColumn('Booking Nama', 'boking_nama', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for boking_email field
            //
            $editor = new TextAreaEdit('boking_email_edit', 50, 8);
            $editColumn = new CustomEditColumn('Booking Email', 'boking_email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for boking_no_hp field
            //
            $editor = new TextEdit('boking_no_hp_edit');
            $editor->SetMaxLength(12);
            $editColumn = new CustomEditColumn('Booking No Hp', 'boking_no_hp', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for boking_room_id field
            //
            $editor = new DynamicCombobox('boking_room_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`room`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Room_Id', true, true, true),
                    new StringField('Room_Name'),
                    new StringField('Room_Desc'),
                    new StringField('Room_Img'),
                    new IntegerField('Room_Capasitas'),
                    new StringField('Room_Class', true),
                    new IntegerField('Room_Price'),
                    new IntegerField('Room_SpecialPrice'),
                    new IntegerField('Room_Business_Price', true)
                )
            );
            $lookupDataset->setOrderByField('Room_Name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Booking Room Id', 'boking_room_id', 'boking_room_id_Room_Name', 'insert_boking_room_id_Room_Name_search', $editor, $this->dataset, $lookupDataset, 'Room_Id', 'Room_Name', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for boking_Harga field
            //
            $editor = new TextEdit('boking_harga_edit');
            $editColumn = new CustomEditColumn('Booking Harga', 'boking_Harga', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for boking_jumlah_jam field
            //
            $editor = new TextEdit('boking_jumlah_jam_edit');
            $editColumn = new CustomEditColumn('Booking Jumlah Jam', 'boking_jumlah_jam', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for boking_waktu field
            //
            $editor = new TimeEdit('boking_waktu_edit', 'H:i:s');
            $editColumn = new CustomEditColumn('Booking Waktu', 'boking_waktu', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for boking_tanggal field
            //
            $editor = new DateTimeEdit('boking_tanggal_edit', false, 'd-m-Y');
            $editColumn = new CustomEditColumn('Booking Tanggal', 'boking_tanggal', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for boking_ket field
            //
            $editor = new ComboBox('boking_ket_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Belum Lunas', 'Belum Lunas');
            $editor->addChoice('DP Bukti Kirim', 'DP Bukti Kirim');
            $editor->addChoice('DP Lunas', 'DP Lunas');
            $editor->addChoice('Lunas', 'Lunas');
            $editor->addChoice('Selesai', 'Selesai');
            $editor->addChoice('Batal', 'Batal');
            $editColumn = new CustomEditColumn('Booking Ket', 'boking_ket', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for boking_total field
            //
            $editor = new TextEdit('boking_total_edit');
            $editColumn = new CustomEditColumn('Booking Total', 'boking_total', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for boking_deposit field
            //
            $editor = new TextEdit('boking_deposit_edit');
            $editColumn = new CustomEditColumn('Booking Deposit', 'boking_deposit', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for boking_Bukti_Dp field
            //
            $editor = new ImageUploader('boking_bukti_dp_edit');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Booking Bukti Dp', 'boking_Bukti_Dp', $editor, $this->dataset, false, false, 'BokingBukti', '%random%.%original_file_extension%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for boking_created field
            //
            $editor = new DateTimeEdit('boking_created_edit', false, 'd-m-Y H:i:s');
            $editColumn = new CustomEditColumn('Booking Created', 'boking_created', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(true && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for boking_id field
            //
            $column = new NumberViewColumn('boking_id', 'boking_id', 'Booking Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for boking_nama field
            //
            $column = new TextViewColumn('boking_nama', 'boking_nama', 'Booking Nama', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('boking01Grid_boking_nama_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for boking_email field
            //
            $column = new TextViewColumn('boking_email', 'boking_email', 'Booking Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('boking01Grid_boking_email_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for boking_no_hp field
            //
            $column = new TextViewColumn('boking_no_hp', 'boking_no_hp', 'Booking No Hp', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Room_Name field
            //
            $column = new TextViewColumn('boking_room_id', 'boking_room_id_Room_Name', 'Booking Room Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for boking_Harga field
            //
            $column = new NumberViewColumn('boking_Harga', 'boking_Harga', 'Booking Harga', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for boking_jumlah_jam field
            //
            $column = new NumberViewColumn('boking_jumlah_jam', 'boking_jumlah_jam', 'Booking Jumlah Jam', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for boking_waktu field
            //
            $column = new DateTimeViewColumn('boking_waktu', 'boking_waktu', 'Booking Waktu', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for boking_tanggal field
            //
            $column = new DateTimeViewColumn('boking_tanggal', 'boking_tanggal', 'Booking Tanggal', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y');
            $grid->AddPrintColumn($column);
            
            //
            // View column for boking_ket field
            //
            $column = new TextViewColumn('boking_ket', 'boking_ket', 'Booking Ket', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for boking_total field
            //
            $column = new NumberViewColumn('boking_total', 'boking_total', 'Booking Total', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for boking_deposit field
            //
            $column = new NumberViewColumn('boking_deposit', 'boking_deposit', 'Booking Deposit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for boking_Bukti_Dp field
            //
            $column = new DownloadExternalDataColumn('boking_Bukti_Dp', 'boking_Bukti_Dp', 'Booking Bukti Dp', $this->dataset, '');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for boking_created field
            //
            $column = new DateTimeViewColumn('boking_created', 'boking_created', 'Booking Created', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for boking_id field
            //
            $column = new NumberViewColumn('boking_id', 'boking_id', 'Booking Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for boking_nama field
            //
            $column = new TextViewColumn('boking_nama', 'boking_nama', 'Booking Nama', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('boking01Grid_boking_nama_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for boking_email field
            //
            $column = new TextViewColumn('boking_email', 'boking_email', 'Booking Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('boking01Grid_boking_email_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for boking_no_hp field
            //
            $column = new TextViewColumn('boking_no_hp', 'boking_no_hp', 'Booking No Hp', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Room_Name field
            //
            $column = new TextViewColumn('boking_room_id', 'boking_room_id_Room_Name', 'Booking Room Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for boking_Harga field
            //
            $column = new NumberViewColumn('boking_Harga', 'boking_Harga', 'Booking Harga', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for boking_jumlah_jam field
            //
            $column = new NumberViewColumn('boking_jumlah_jam', 'boking_jumlah_jam', 'Booking Jumlah Jam', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for boking_waktu field
            //
            $column = new DateTimeViewColumn('boking_waktu', 'boking_waktu', 'Booking Waktu', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for boking_tanggal field
            //
            $column = new DateTimeViewColumn('boking_tanggal', 'boking_tanggal', 'Booking Tanggal', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y');
            $grid->AddExportColumn($column);
            
            //
            // View column for boking_ket field
            //
            $column = new TextViewColumn('boking_ket', 'boking_ket', 'Booking Ket', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for boking_total field
            //
            $column = new NumberViewColumn('boking_total', 'boking_total', 'Booking Total', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for boking_deposit field
            //
            $column = new NumberViewColumn('boking_deposit', 'boking_deposit', 'Booking Deposit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for boking_Bukti_Dp field
            //
            $column = new DownloadExternalDataColumn('boking_Bukti_Dp', 'boking_Bukti_Dp', 'Booking Bukti Dp', $this->dataset, '');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for boking_created field
            //
            $column = new DateTimeViewColumn('boking_created', 'boking_created', 'Booking Created', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for boking_nama field
            //
            $column = new TextViewColumn('boking_nama', 'boking_nama', 'Booking Nama', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('boking01Grid_boking_nama_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for boking_email field
            //
            $column = new TextViewColumn('boking_email', 'boking_email', 'Booking Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('boking01Grid_boking_email_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for boking_no_hp field
            //
            $column = new TextViewColumn('boking_no_hp', 'boking_no_hp', 'Booking No Hp', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Room_Name field
            //
            $column = new TextViewColumn('boking_room_id', 'boking_room_id_Room_Name', 'Booking Room Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for boking_Harga field
            //
            $column = new NumberViewColumn('boking_Harga', 'boking_Harga', 'Booking Harga', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for boking_jumlah_jam field
            //
            $column = new NumberViewColumn('boking_jumlah_jam', 'boking_jumlah_jam', 'Booking Jumlah Jam', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for boking_waktu field
            //
            $column = new DateTimeViewColumn('boking_waktu', 'boking_waktu', 'Booking Waktu', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for boking_tanggal field
            //
            $column = new DateTimeViewColumn('boking_tanggal', 'boking_tanggal', 'Booking Tanggal', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y');
            $grid->AddCompareColumn($column);
            
            //
            // View column for boking_ket field
            //
            $column = new TextViewColumn('boking_ket', 'boking_ket', 'Booking Ket', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for boking_total field
            //
            $column = new NumberViewColumn('boking_total', 'boking_total', 'Booking Total', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for boking_deposit field
            //
            $column = new NumberViewColumn('boking_deposit', 'boking_deposit', 'Booking Deposit', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for boking_Bukti_Dp field
            //
            $column = new DownloadExternalDataColumn('boking_Bukti_Dp', 'boking_Bukti_Dp', 'Booking Bukti Dp', $this->dataset, '');
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for boking_created field
            //
            $column = new DateTimeViewColumn('boking_created', 'boking_created', 'Booking Created', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $grid->AddCompareColumn($column);
        }
    
        private function AddCompareHeaderColumns(Grid $grid)
        {
    
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        public function isFilterConditionRequired()
        {
            return false;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        
        public function GetEnableModalGridInsert() { return true; }
        public function GetEnableModalSingleRecordView() { return true; }
        
        public function GetEnableModalGridEdit() { return true; }
        
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(true);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(true);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && true);
            $result->setTableBordered(true);
            $result->setTableCondensed(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddMultiEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddMultiUploadColumn($result);
    
    
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
            $this->setPrintListAvailable(true);
            $this->setPrintListRecordAvailable(true);
            $this->setPrintOneRecordAvailable(true);
            $this->setAllowPrintSelectedRecords(true);
            $this->setExportListAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportSelectedRecordsAvailable(array());
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            //
            // View column for boking_nama field
            //
            $column = new TextViewColumn('boking_nama', 'boking_nama', 'Booking Nama', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'boking01Grid_boking_nama_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for boking_email field
            //
            $column = new TextViewColumn('boking_email', 'boking_email', 'Booking Email', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'boking01Grid_boking_email_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for boking_nama field
            //
            $column = new TextViewColumn('boking_nama', 'boking_nama', 'Booking Nama', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'boking01Grid_boking_nama_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for boking_email field
            //
            $column = new TextViewColumn('boking_email', 'boking_email', 'Booking Email', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'boking01Grid_boking_email_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for boking_nama field
            //
            $column = new TextViewColumn('boking_nama', 'boking_nama', 'Booking Nama', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'boking01Grid_boking_nama_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for boking_email field
            //
            $column = new TextViewColumn('boking_email', 'boking_email', 'Booking Email', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'boking01Grid_boking_email_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`room`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Room_Id', true, true, true),
                    new StringField('Room_Name'),
                    new StringField('Room_Desc'),
                    new StringField('Room_Img'),
                    new IntegerField('Room_Capasitas'),
                    new StringField('Room_Class', true),
                    new IntegerField('Room_Price'),
                    new IntegerField('Room_SpecialPrice'),
                    new IntegerField('Room_Business_Price', true)
                )
            );
            $lookupDataset->setOrderByField('Room_Name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_boking_room_id_Room_Name_search', 'Room_Id', 'Room_Name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`room`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Room_Id', true, true, true),
                    new StringField('Room_Name'),
                    new StringField('Room_Desc'),
                    new StringField('Room_Img'),
                    new IntegerField('Room_Capasitas'),
                    new StringField('Room_Class', true),
                    new IntegerField('Room_Price'),
                    new IntegerField('Room_SpecialPrice'),
                    new IntegerField('Room_Business_Price', true)
                )
            );
            $lookupDataset->setOrderByField('Room_Name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_boking_room_id_Room_Name_search', 'Room_Id', 'Room_Name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for boking_nama field
            //
            $column = new TextViewColumn('boking_nama', 'boking_nama', 'Booking Nama', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'boking01Grid_boking_nama_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for boking_email field
            //
            $column = new TextViewColumn('boking_email', 'boking_email', 'Booking Email', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'boking01Grid_boking_email_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`room`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Room_Id', true, true, true),
                    new StringField('Room_Name'),
                    new StringField('Room_Desc'),
                    new StringField('Room_Img'),
                    new IntegerField('Room_Capasitas'),
                    new StringField('Room_Class', true),
                    new IntegerField('Room_Price'),
                    new IntegerField('Room_SpecialPrice'),
                    new IntegerField('Room_Business_Price', true)
                )
            );
            $lookupDataset->setOrderByField('Room_Name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_boking_room_id_Room_Name_search', 'Room_Id', 'Room_Name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
        }
       
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderPrintColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderExportColumn($exportType, $fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomDrawRow($rowData, &$cellFontColor, &$cellFontSize, &$cellBgColor, &$cellItalicAttr, &$cellBoldAttr)
        {
    
        }
    
        protected function doExtendedCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles, &$rowClasses, &$cellClasses)
        {
    
        }
    
        protected function doCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
    
        }
    
        public function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doCustomCompareColumn($columnName, $valueA, $valueB, &$result)
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeUpdateRecord($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeDeleteRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterUpdateRecord($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterDeleteRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doCustomHTMLHeader($page, &$customHtmlHeaderText)
        { 
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomExportOptions(Page $page, $exportType, $rowData, &$options)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        protected function doPrepareChart(Chart $chart)
        {
    
        }
    
        protected function doPrepareColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function doPrepareFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doGetCustomColumnGroup(FixedKeysArray $columns, ViewColumnGroup $columnGroup)
        {
    
        }
    
        protected function doPageLoaded()
        {
    
        }
    
        protected function doCalculateFields($rowData, $fieldName, &$value)
        {
    
        }
    
        protected function doGetCustomPagePermissions(Page $page, PermissionSet &$permissions, &$handled)
        {
    
        }
    
        protected function doGetCustomRecordPermissions(Page $page, &$usingCondition, $rowData, &$allowEdit, &$allowDelete, &$mergeWithDefault, &$handled)
        {
    
        }
    
    }

    SetUpUserAuthorization();

    try
    {
        $Page = new boking01Page("boking01", "Booking .php", GetCurrentUserPermissionSetForDataSource("boking01"), 'UTF-8');
        $Page->SetTitle('Booking');
        $Page->SetMenuLabel('Booking ');
        $Page->SetHeader(GetPagesHeader());
        $Page->SetFooter(GetPagesFooter());
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("boking01"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
