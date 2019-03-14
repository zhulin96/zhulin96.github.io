library(data.table)

crfo<-function(x){
    rltnet=data.table(read.table("/usr/share/nginx/html/process/file/net.csv",header=FALSE,sep=","))
    x=data.table(t(read.table("/usr/share/nginx/html/process/file/netform.csv",header=FALSE,sep=",")))$V1
    setnames(rltnet,"V1","col")
    tt=rltnet$col
    for(i in tt){
        setnames(rltnet,paste("V",i+1,sep=""),paste(i))
    }
    col=c(1:length(x))
    rltn=data.table(col)
    col=rltnet$col
    if(length(x)>=2){
        for(i in x){
            start=i
            rlt=data.table(start)
            for(j in 1:length(x)){
                if(start==0) break
                negr=data.table(cbind(rltnet$col,t(rltnet[rltnet$col==start,])[2:(length(col)+1)]))
                setkey(negr,V2)
                negr=negr[!(negr$V2==0),]
                nextn=length(negr$V1)
                judge=TRUE
                while(judge){
                    if(nextn==0){
                        judge==0
                        break
                    }
                    af=negr[nextn,V1]
                    start=af
                    judge=FALSE
                    if(!any(x==af)){
                        nextn=nextn-1
                        judge=TRUE
                        next
                    }
                    if(any(rlt==af)){
                        nextn=nextn-1
                        judge=TRUE
                        next
                    }
                }
                if(!judge){
                    rlt=rbind(rlt,data.table(start))
                }
                else{
                    start=0
                }
            }
            k=length(rlt$start)
            if(k<length(x)){
                for(m in (k+1):length(x)){
                    start=as.numeric(NA)
                    rlt=rbind(rlt,data.table(start))
                }
            }
            rltn=cbind(rltn,rlt)
            setnames(rltn,"start",paste("from_",i,sep=""))
        }
        rltn[,col:=NULL]
    }
    else{
        rltn=data.table(x)
        setnames(rltn,"x",paste("from_",x,sep=""))
    }
    write.table(rltn,"/usr/share/nginx/html/process/file/roads.csv",sep=",",row.names = FALSE,col.names = FALSE)
}

# RUN!
crfo()
i<-2
i
