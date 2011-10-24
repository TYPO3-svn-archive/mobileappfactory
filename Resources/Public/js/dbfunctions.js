
var localDB={
	
	start:function(options){
		
		//prevent IE errors if console.log is called
		var alertFallback = false;
		if (typeof console === "undefined" || typeof console.log === "undefined") {
			console = {};
			if (alertFallback) {
				console.log = function(msg) {
					alert(msg);
				};
			} else {
				console.log = function() {};
			}
		}
	
		if (options){
			this.options=options;
			this.dbBrowse=new Array();
			
			if(window.openDatabase){
				var shortName = options.name;
				var version = '';
				var displayName = '';
				var maxSize = 65536; // in bytes
				this.db = openDatabase(shortName, version, displayName, maxSize);
				
			
				if (this.db.version!=options.version)
					this.create();
				else{
					if (this.options.create.callbacks&&this.options.create.callbacks.finish)
						this.options.create.callbacks.finish();
				}
			} else
				console.log('no openDatabase');
		}
	},



	create:function(){
		var options=this.options;
		var thisClass=this;
		if (this.options.create){
			if (this.options.create.callbacks&&this.options.create.callbacks.start)
				this.options.create.callbacks.start();
			
			if (this.options.create.sql){
				this.execute(
					this.options.create.sql,
					function(trx, result){
						console.log('done',options);
						thisClass.db.changeVersion(thisClass.db.version, options.version);
						if (options.create.callbacks&&options.create.callbacks.finish)
							options.create.callbacks.finish();
					},
					function(error){
						console.log('error',error);
						if (options.create.callbacks&&options.create.callbacks.error)
							options.create.callbacks.error();
					}
				);
			
			}
		}
	},

	execute:function(sql,successCallback,errorCallback){
		
		this.db.transaction(
			function(tx){
				var statements=sql.split(';');
				for(var i in statements){
					if (statements[i])
						tx.executeSql(statements[i]);
				}
			},
			errorCallback,
			successCallback
			
		);
	},

	query:function(sql,successCallback,errorCallback){
		var result;
		this.db.transaction(
			function(tx){
				var statements=sql.split(';');
				for(var i in statements){
					if (statements[i])
						tx.executeSql(statements[i],[],successCallback);
				}
			},
			errorCallback
			
		);
	},


	update:function(table,fields,cbSuccess,cbError){
		var i;
		var id=0;
		var sql='';
		for(i=0, max=fields.length; i < max; i++) {
			var field = fields[i];
			if (field.name!='submit'){
				if (field.name=='id'){
					id=field.value;
				}
			}
		}
		console.log('id',id);
		if (id!=0&&id!='0'){
		
			for(i=0, max=fields.length; i < max; i++) {
				var field = fields[i];
				if ((field.name!='submit')&&(field.name!='id')){
					if (sql.length)
						sql+=', ';
					sql+=field.name+'="'+field.value+'"';
					
				}
				
			}
			sql='update '+table+' set '+sql+' where id='+id;
			
		 }else{
			var sqlValues=''
			var sqlNames='';
			for(i=0, max=fields.length; i < max; i++) {
				var field = fields[i];
				if ((field.name!='submit')&&(field.name!='id')){
					if (sqlNames.length)
						sqlNames+=',';
					sqlNames+=field.name;	
					if (sqlValues.length)
						sqlValues+=', ';
					sqlValues+='"'+field.value+'"';
					
				}
				
			}
			sql='insert into '+table+' ('+sqlNames+') values ('+sqlValues+')';
			
			
		
		}
		if (sql.length){
			console.log(sql);
			this.query(
				sql,
				function(trx, result){
					if (cbSuccess){
						cbSuccess(result);
					}
					
					
				},
				function(error){
					if (cbError)
						cbError(error)
					
					
				}
			);
		
		}
	},

	getRecords:function(table,whereClauses,cbSuccess,cbError){
		var i;
		var id=0;
		var sql='';
		console.log('wc',whereClauses);
			var sqlWhere=''
			for (var i in whereClauses){
				var whereClause = whereClauses[i];
				var operation='and';
				var compare='=';
				var field=whereClause.field
				var value=whereClause.value;
				if ((typeof(value)=='string')&&(value.charAt(0)=='#'))
					value=this.getCurrentTableRow(value.substring(1));
				
				if (whereClause.operation)
					operation=whereClause.operation;
				
				if (whereClause.compare)
					compare=whereClause.compare;
				
				if (sqlWhere.length)
					sqlWhere+=' '+operation+' ';
				sqlWhere+=field+compare+'"'+value+'"';
			}
			sql='select * from '+table;
			if (sqlWhere.length)
				sql+=' where '+sqlWhere;
			
			console.log(sql);
			this.query(
				sql,
				function(trx, result){
					cbSuccess(result.rows);
					
				},
				function(error){
					cbError(error);
					
				}
			);
		
		
	},
	
	getRecord:function(table,id,cbSuccess,cbError){
		this.getRecords(table,
			[{field:'id',value:id}],
			function(rows){
				if (rows.length)
					cbSuccess(rows.item(0));
				else
					cbSuccess(null);
			},			
			cbError
		);
	},

	setCurrentTableRow:function(table,id){
		console.log(this.dbBrowse);
		this.dbBrowse[table]=id;
	},

	getCurrentTableRow:function(table){
		return this.dbBrowse[table];
	}

}